<?php

use Illuminate\Database\Seeder;

class PublishersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\Publisher::class, 10)->create();
	}
}
