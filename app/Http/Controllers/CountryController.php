<?php

namespace App\Http\Controllers;

use App\Country;

class CountryController extends BackendController {

	public function index() {
		return Country::find(1)->posts;
	}
}
