<?php

namespace App\Extensions;

use App\Builders\ElasticMapping;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;
use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;

class ElasticsearchEngine extends Engine {
	/**
	 * The Elasticsearch client instance.
	 *
	 * @var \Elasticsearch\Client
	 */
	protected $elasticsearch;

	/**
	 * The index name.
	 *
	 * @var string
	 */
	protected $index;

	/**
	 * Create a new engine instance.
	 *
	 * @param  \Elasticsearch\Client $elasticsearch
	 * @return void
	 */
	public function __construct($client, $index) {
		$this->elasticsearch = $client;
		$this->index = $index;
	}

	/**
	 * Update the given model in the index.
	 *
	 * @param  Collection $models
	 * @return void
	 */
	public function update($models) {

		$body = new BaseCollection();

		$models->each(function ($model) use ($body) {
			$array = $model->toSearchableArray();

			if (empty($array)) {
				return;
			}

			if (!$this->elasticsearch->indices()->exists(['index' => $this->index])) {
				$params = [
					'index' => $this->index,
					'body' => [
						'settings' => [
							'analysis' => [
								"analyzer" => [
									'pinyin_analyzer' => [
										'type' => 'custom',
										'tokenizer' => 'ik_smart',
										'filter' => ['word_delimiter'],
									],
									'ik_smart_pinyin' => [
										'type' => 'custom',
										'tokenizer' => 'my_pinyin',
										'filter' => ['single_pinyin'],
									],
								],
								'tokenizer' => [
									'my_pinyin' => [
										'type' => 'pinyin',
										'keep_first_letter' => true,
										'keep_separate_first_letter' => false,
										'keep_full_pinyin' => true,
										'keep_joined_full_pinyin' => true,
										'keep_original' => true,
										'trim_whitespace' => true,
										'limit_first_letter_length' => 16,
										'lowercase' => true,
									],
								],
								'filter' => [
									'single_pinyin' => [
										'type' => 'pinyin',
										'keep_first_letter' => false,
										'keep_separate_first_letter' => false,
										'keep_full_pinyin' => true,
										'keep_joined_full_pinyin' => true,
										'limit_first_letter_length' => 16,
										'keep_original' => false,
										'lowercase' => true,
									],
								],
							],
						],
						'mappings' => ElasticMapping::gather(),
					],
				];
				$this->elasticsearch->indices()->create($params);
			}

			$body->push([
				'index' => [
					'_index' => $this->index,
					'_type' => $model->searchableAs(),
					'_id' => $model->getKey(),
				],
			]);

			$body->push($array);
		});

		$this->elasticsearch->bulk([
			'refresh' => true,
			'body' => $body->all(),
		]);
	}

	/**
	 * Remove the given model from the index.
	 *
	 * @param  Collection $models
	 * @return void
	 */
	public function delete($models) {
		$body = new BaseCollection();

		$models->each(function ($model) use ($body) {
			$body->push([
				'delete' => [
					'_index' => $this->index,
					'_type' => $model->searchableAs(),
					'_id' => $model->getKey(),
				],
			]);
		});

		$this->elasticsearch->bulk([
			'refresh' => true,
			'body' => $body->all(),
		]);
	}

	/**
	 * Perform the given search on the engine.
	 *
	 * @param  Builder $query
	 * @return mixed
	 */
	public function search(Builder $query) {
		return $this->performSearch($query, [
			'filters' => $this->filters($query),
			'size' => $query->limit ?: 10000,
		]);
	}

	/**
	 * Perform the given search on the engine.
	 *
	 * @param  Builder $builder
	 * @param  array $options
	 * @return mixed
	 */
	protected function performSearch(Builder $builder, array $options = []) {

		$filters = [];

		$term = strtolower($builder->query);

		foreach (explode(' ', $term) as $piece) {
			$matches[] = [
				'prefix' => ["_all" => $piece],
			];
		}

		if (array_key_exists('filters', $options) && $options['filters']) {
			foreach ($options['filters'] as $field => $value) {

				if (is_numeric($value)) {
					$filters[] = [
						'term' => [
							$field => $value,
						],
					];
				} elseif (is_string($value)) {
					$matches[] = [
						'match' => [
							$field => [
								'query' => $value,
								'operator' => 'and',
							],
						],
					];
				}
			}
		}

		$query = [
			'index' => $this->index,
			'type' => $builder->model->searchableAs(),
			'body' => [
				'query' => [
					'multi_match' => [
						'query' => $builder->query,
						"fields" => ["content"],
					],
				],
				'highlight' => $builder->model->getHighlightFields(),
			],
		];

		if (array_key_exists('size', $options)) {
			$query['size'] = $options['size'];
		}

		if (array_key_exists('from', $options)) {
			$query['from'] = $options['from'];
		}

		if ($builder->callback) {
			return call_user_func(
				$builder->callback,
				$this->elasticsearch,
				$query
			);
		}

		return $this->elasticsearch->search($query);
	}

	/**
	 * Get the filter array for the query.
	 *
	 * @param  Builder $query
	 * @return array
	 */
	protected function filters(Builder $query) {
		return $query->wheres;
	}

	/**
	 * Perform the given search on the engine.
	 *
	 * @param  Builder $query
	 * @param  int $perPage
	 * @param  int $page
	 * @return mixed
	 */
	public function paginate(Builder $query, $perPage, $page) {
		$result = $this->performSearch($query, [
			'filters' => $this->filters($query),
			'size' => $perPage,
			'from' => (($page * $perPage) - $perPage),
		]);

		$result['nbPages'] = (int) ceil($result['hits']['total'] / $perPage);
		return $result;
	}

	/**
	 * Pluck and return the primary keys of the given results.
	 *
	 * @param  mixed  $results
	 * @return \Illuminate\Support\Collection
	 */
	public function mapIds($results) {
		return collect($results['hits']['hits'])
			->pluck('_id')
			->values()
			->all();
	}

	/**
	 * Map the given results to instances of the given model.
	 *
	 * @param  mixed $results
	 * @param  \Illuminate\Database\Eloquent\Model $model
	 * @return Collection|BaseCollection
	 */
	public function map($results, $model) {

		if (count($results['hits']) === 0) {
			return Collection::make();
		}

		$keys = collect($results['hits']['hits'])
			->pluck('_id')
			->values()
			->all();

		$models = $model->whereIn(
			$model->getQualifiedKeyName(), $keys
		)->get()->keyBy($model->getKeyName());

		return Collection::make($results['hits']['hits'])->map(function ($hit) use ($model, $models) {

			$record = $models[$hit['_source'][$model->getKeyName()]] ?: $model;

			$record->highlights = $hit['highlight'];

			return $record;

		})->filter()->values();
	}

	/**
	 * Get the total count from a raw result returned by the engine.
	 *
	 * @param  mixed $results
	 * @return int
	 */
	public function getTotalCount($results) {
		return $results['hits']['total'];
	}
}