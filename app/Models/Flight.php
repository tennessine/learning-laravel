<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model {
	use SoftDeletes;
	// white list
	// protected $fillable = ['name', 'destination', 'active', 'delayed'];

	// black list
	protected $guarded = ['id'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];
}
