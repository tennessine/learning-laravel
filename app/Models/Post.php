<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model {
	use Searchable;

	/**
	 * 获取关键词高亮的字段
	 * @return Array
	 */
	public function getHighlightFields() {
		return [
			'fields' => [
				// 'title' => [
				// 	'number_of_fragments' => 0,
				// ],
				'content' => [
					'number_of_fragments' => 0,
				],
				// '_all' => new \stdClass,
			],
		];
	}

	/**
	 * 获取映射
	 * @return Array
	 */
	public function getFieldMappings() {
		return [
			'title' => [
				'type' => 'text',
				// analyzed 当成全文来搜索
				// not_analyzed 当成一个准确的值
				// no 不可被搜索
				'index' => 'no',
				'analyzer' => 'ik_smart_pinyin',
				'store' => 'no',
				'term_vector' => 'with_positions_offsets',
				'boost' => 10,

				'include_in_all' => true,
			],
			'id' => [
				'type' => 'integer',
				'include_in_all' => true,
			],
			'content' => [
				'type' => 'text',
				'analyzer' => 'ik_smart',
				'search_analyzer' => 'ik_max_word',
				'boost' => 8,
				'include_in_all' => true,
			],
		];
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray() {
		return [
			'id' => $this->id,
			'title' => $this->title,
			'content' => $this->content,
		];
	}

	protected $fillable = ['user_id', 'title', 'content'];

	public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}

	public function tags() {
		return $this->morphToMany('App\Tag', 'taggable');
	}

	public function votes() {
		return $this->morphMany('App\Vote', 'voteable');
	}
}
