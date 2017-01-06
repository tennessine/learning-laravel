<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('votes', function (Blueprint $table) {
			// which user
			$table->integer('user_id');
			// voteable_id、voteable_type
			// 1, App\Post、2, App\Video、3, App\Comment
			$table->morphs('voteable');
			// ip address
			$table->ipAddress('ip');
			// vote on that time
			$table->timestamp('voted_at');

			// one user can vote only once
			$table->primary(['user_id', 'voteable_id', 'voteable_type', 'ip']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('votes');
	}
}
