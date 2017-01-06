<?php

namespace App\Http\Controllers;

use App\Contact;

class ContactController extends BackendController {
	public function index() {
		return Contact::all();
	}
}
