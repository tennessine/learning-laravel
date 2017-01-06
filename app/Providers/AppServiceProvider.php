<?php

namespace App\Providers;

use App\Extensions\ElasticsearchEngine;
use App\Models\User;
use App\Observers\UserObserver;
use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		DB::listen(function ($query) {
			// var_dump($query->sql);
		});

		User::observe(UserObserver::class);

		Relation::morphMap([
			'posts' => App\Post::class,
			'videos' => App\Video::class,
		]);

		resolve(EngineManager::class)->extend('elasticsearch', function () {
			return new ElasticsearchEngine(
				ClientBuilder::create()->setHosts(config('scout.elasticsearch.config.hosts'))
					->build(),
				config('scout.elasticsearch.index')
			);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
