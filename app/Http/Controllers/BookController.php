<?php

namespace App\Http\Controllers;

use App\Book;

class BookController extends BackendController {

	public function index() {
		// return Book::with('author.contacts')->get();
		//
		$books = Book::all();
		var_dump($books->load('author'));
	}
}
