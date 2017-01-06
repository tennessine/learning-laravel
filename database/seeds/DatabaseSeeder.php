<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->call(UsersTableSeeder::class);
		$this->call(FlightsTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(PhonesTableSeeder::class);
		$this->call(AddressesTableSeeder::class);
		$this->call(PostsTableSeeder::class);
		$this->call(CommentsTableSeeder::class);
		$this->call(CountriesTableSeeder::class);
		$this->call(VideosTableSeeder::class);
		$this->call(TagsTableSeeder::class);
		$this->call(BooksTableSeeder::class);
		$this->call(AuthorsTableSeeder::class);
		$this->call(PublishersTableSeeder::class);
		$this->call(ContactsTableSeeder::class);
	}
}
