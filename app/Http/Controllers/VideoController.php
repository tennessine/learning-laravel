<?php

namespace App\Http\Controllers;

use App\Video;

class VideoController extends BackendController {
	public function index() {
		// return get_class(Comment::find(1)->commentable);
		return Video::find(1)->tags;
	}
}
