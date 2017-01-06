<?php

namespace App\Http\Controllers;

use App\Publisher;

class PublisherController extends BackendController {
	public function index() {
		return Publisher::all();
	}
}
