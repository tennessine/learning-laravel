<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model {
	public $primaryKey = 'user_id';
	public $timestamps = false;
	public $incrementing = false;

	public function user() {
		return $this->belongsTo('App\User');
	}
}
