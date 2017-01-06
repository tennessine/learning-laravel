<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		// Let's start by creating the following Roles and Permissions:
		$owner = new Role();
		$owner->name = 'owner';
		$owner->display_name = 'Project Owner'; // optional
		$owner->description = 'User is the owner of a given project'; // optional
		$owner->save();

		$admin = new Role();
		$admin->name = 'admin';
		$admin->display_name = 'User Administrator'; // optional
		$admin->description = 'User is allowed to manage and edit other users'; // optional
		$admin->save();

		// Next, with both roles created let's assign them to the users. Thanks to the HasRole trait this is as easy as:

		$user = User::where('email', 'admin@w3hacker.com')->first();

		// role attach alias
		$user->attachRole($admin); // parameter can be an Role object, array, or id

		// or eloquent's original technique
		// $user->roles()->attach($admin->id); // id only
		//
		// Now we just need to add permissions to those Roles:
		$createPost = new Permission();
		$createPost->name = 'create-post';
		$createPost->display_name = 'Create Posts'; // optional
		// Allow a user to...
		$createPost->description = 'create new blog posts'; // optional
		$createPost->save();

		$editUser = new Permission();
		$editUser->name = 'edit-user';
		$editUser->display_name = 'Edit Users'; // optional
		// Allow a user to...
		$editUser->description = 'edit existing users'; // optional
		$editUser->save();

		$admin->attachPermission($createPost);
		// equivalent to $admin->perms()->sync(array($createPost->id));

		$owner->attachPermissions(array($createPost, $editUser));
		// equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
	}
}
