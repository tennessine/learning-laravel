<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\User::class, 100)->create();

		factory(App\User::class, 1)->create([
			'name' => 'admin',
			'email' => 'admin@w3hacker.com',
			'password' => bcrypt('gkf986512'),
			'country_id' => 1,
			'api_token' => str_random(60),
		]);
	}
}
