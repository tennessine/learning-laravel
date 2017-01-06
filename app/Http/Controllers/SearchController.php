<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller {

	public function index() {
		$client = ClientBuilder::create()->build();
		$params = [

		];
	}

	public function search($keyword) {
		$posts = Post::search($keyword)->paginate(1);
		return view('index', compact('posts'));
	}

	public function create() {
		return view('create');
	}

	public function publish(Request $request) {
		$data = $request->all();
		$data['user_id'] = Auth::id();
		$post = Post::create($data);
		return redirect()->back()->with('status', '发布成功');
	}
}
