<?php

namespace App\Http\Controllers;

use App\User;

class RoleController extends BackendController {

	public function index() {
		return User::find(1)->roles;
	}
}
