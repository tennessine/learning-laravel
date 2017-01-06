<?php

namespace App\Http\Controllers;

use App\Phone;

class PhoneController extends BackendController {

	public function index() {
		return Phone::find(1)->user;
	}
}
