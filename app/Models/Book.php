<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
	public function author() {
		return $this->belongsTo('App\Author');
	}

	public function publisher() {
		return $this->belongsTo('App\Publisher');
	}
}
