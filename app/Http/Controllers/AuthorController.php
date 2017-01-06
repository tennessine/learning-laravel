<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends BackendController {
	public function index() {
		return Author::find(1);
	}
}
