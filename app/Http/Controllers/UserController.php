<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller {

	public function index(\Faker\Generator $faker) {

		// $user = User::find(101);
		// $user->roles()->detach(1);
		// $user->roles()->attach(1, ['priority' => 1]);
		//
		$users = User::find([1, 2, 3]);

		// $options = [
		// 	'married' => false,
		// ];

		// $user->options = $options;
		// $user->save();
		// return $user->options;
		// var_dump($users->toArray());
		// var_dump($users->toJson());

		// return $user->created_at->getTimestamp();
		// return (string) $users->makeVisible('name')->makeHidden('email');

		return $faker->name;
	}
}
