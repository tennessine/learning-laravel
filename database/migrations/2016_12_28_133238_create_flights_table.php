<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('flights', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('airline_id');
			$table->string('name');
			$table->string('departure');
			$table->string('destination');
			$table->float('price');
			$table->tinyInteger('active')->default(0)->index();
			$table->tinyInteger('delayed')->default(0)->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('flights');
	}
}
