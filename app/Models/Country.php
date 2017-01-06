<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
	public $timestamps = false;

	public function posts() {
		return $this->hasManyThrough('App\Post', 'App\User', 'country_id', 'user_id', 'id');
	}
}
