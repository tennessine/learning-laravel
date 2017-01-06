<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Comment extends Model {

	use Searchable;

	protected $fillable = ['parent_id', 'content'];

	protected $touches = ['commentable'];

	public function commentable() {
		return $this->morphTo();
	}
}
