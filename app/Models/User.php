<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {
	use Notifiable, EntrustUserTrait;

	// protected $dateFormat = 'U';

	protected $dates = ['created_at', 'updated_at'];

	protected $casts = ['options' => 'array'];

	public function getNameAttribute($value) {
		// var_dump($value);
		return $value;
	}

	public function getIsAdminAttribute() {
		return $this->attributes['address_id'] == 1;
	}

	public function setNameAttribute($value) {
		$this->attributes['name'] = bcrypt($value);
	}

	// public function roles() {
	// 	return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->wherePivot('approved', 0)->wherePivotIn('priority', [0, 1, 2])->withPivot('approved', 'priority');
	// }
	//

	public function phone() {
		return $this->hasOne('App\Phone', 'user_id');
	}

	public function address() {
		return $this->hasOne('App\Address', 'id', 'address_id');
	}

	public function posts() {
		return $this->hasMany('App\Post');
	}

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot() {
		parent::boot();

		// static::addGlobalScope(new AgeScope);
		// static::addGlobalScope('age', function (Builder $builder) {
		// 	$builder->where('age', 4);
		// });
	}

	/**
	 * Scope a query to only include popular users.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 *
	 * @author w3hacker <admin@w3hacker.com>
	 */
	public function scopePopular($query) {
		return $query->where('votes', '>', 1);
	}

	/**
	 * Scope a query to only include active users.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 *
	 * @author w3hacker <admin@w3hacker.com>
	 */
	public function scopeActive($query) {
		return $query->where('active', 0);
	}

	/**
	 * Scope a query to only include users of a given type.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param mixed $type
	 * @return \Illuminate\Database\Eloquent\Builder
	 *
	 * @author w3hacker <admin@w3hacker.com>
	 */
	public function scopeOfType($query, $type) {
		return $query->where('type', $type);
	}

	protected $appends = ['is_admin'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'country_id',
	];

	protected $visible = ['email', 'is_admin'];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token', 'api_token',
	];
}
