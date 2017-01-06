<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('country_id')->index();
			$table->string('name')->default('');
			$table->tinyInteger('age')->default(0);
			$table->integer('votes')->default(0);
			$table->string('email')->unique();
			$table->string('api_token', 60)->unique();
			$table->string('password');
			$table->integer('address_id')->default(0)->index();
			$table->tinyInteger('active')->default(0);
			$table->text('options');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}
}
