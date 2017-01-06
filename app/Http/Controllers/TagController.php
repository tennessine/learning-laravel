<?php

namespace App\Http\Controllers;

use App\Tag;

class TagController extends BackendController {
	public function index() {
		return Tag::find(2)->videos;
	}
}
