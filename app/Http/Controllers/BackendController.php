<?php

namespace App\Http\Controllers;

class BackendController extends Controller {
	public function __construct() {
		$this->middleware('role:admin');
	}
}
