<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase {
	// use DatabaseMigrations;
	use DatabaseTransactions;
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample() {
		$this->seeInDatabase('users', [
			'email' => 'admin@w3hacker.com',
		]);
	}
}
