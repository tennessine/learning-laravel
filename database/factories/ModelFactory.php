<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'country_id' => 1,
		'votes' => $faker->randomDigit,
		'age' => $faker->randomDigit,
		'email' => $faker->unique()->safeEmail,
		'api_token' => str_random(60),
		'address_id' => 1,
		'options' => '',
		'password' => $password ?: $password = bcrypt('gkf986512'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('gkf986512'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Flight::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->name,
		'airline_id' => 1,
		'departure' => $faker->city,
		'destination' => $faker->city,
		'price' => $faker->randomFloat(2, 10, 100),
		'active' => $faker->randomElement([0, 1]),
		'delayed' => $faker->randomElement([0, 1]),
	];
});

$factory->define(App\Phone::class, function (Faker\Generator $faker) {

	return [
		'user_id' => 1,
		'phone' => $faker->phoneNumber,
	];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->address,
	];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

	return [
		'user_id' => 1,
		'title' => $faker->sentence,
		'content' => $faker->paragraph,
	];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

	return [
		'parent_id' => 0,
		'content' => $faker->paragraph,
		'commentable_id' => 1,
		'commentable_type' => 'App\Post',
	];
});

$factory->define(App\Country::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->country,
	];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {

	return [
		'title' => $faker->sentence,
		'url' => $faker->url,
	];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->unique()->creditCardType,
	];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {

	return [
		'author_id' => 1,
		'title' => $faker->sentence,
		'pubisher_id' => 1,
		'publisher_name' => '',
	];
});

$factory->define(App\Author::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->name,
	];
});

$factory->define(App\Publisher::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->name,
	];
});

$factory->define(App\Contact::class, function (Faker\Generator $faker) {

	return [
		'contactable_id' => 1,
		'contactable_type' => 'App\Author',
		'phone' => $faker->phoneNumber,
		'address' => $faker->address,
	];
});