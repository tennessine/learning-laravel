<?php

namespace App\Http\Controllers;

use HelloWorld\SayHello;

class PostController extends Controller {

	public function index() {

		echo SayHello::sayHello();

		// Excel::create('Laravel Excel', function ($excel) {

		// 	$excel->sheet('Excel sheet', function ($sheet) {

		// 		$sheet->setOrientation('landscape');
		// 	});

		// })->export('xls');

		// $post = new Post();
		// $post->user_id = 1;
		// $post->title = '中国的原始社会';
		// $post->content = '中国的原始社会，起自大约170万年前的元谋人，止于公元前21世纪夏王朝的建立。原始社会经历了原始人群和氏族公社两个时期。氏族公社又经历了母系氏族公社和父系氏族公社两个阶段。';
		// $post->save();

		// return Post::find(1)->comments()->where('parent_id', 0)->first();

		// return Post::withCount(['comments', 'votes'])->get();
		//
		// $faker = Factory::create();

		// $one_comment = new Comment(['parent_id' => 0, 'content' => $faker->paragraph()]);

		// $another_comment = new Comment(['parent_id' => 0, 'content' => $faker->paragraph()]);

		// $post = Post::find(1);
		// // return $post->comments()->save($comment);
		// return $post->comments()->saveMany([
		// 	$one_comment,
		// 	$another_comment,
		// ]);
		//
		// $comment = Comment::find(1);
		// $comment->content = 'changed';
		// $comment->save();

		// return $comment->commentable;
	}
}
