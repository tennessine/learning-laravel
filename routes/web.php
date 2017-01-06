<?php

use App\Flight;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/flight/create', 'FlightController@create');
Route::post('/flight/store', 'FlightController@store');
Route::get('/flight', 'FlightController@index');
Route::get('/flight/{flight}/edit', 'FlightController@edit');
Route::put('/flight/{flight}/update', 'FlightController@update')->name('flight.update');

Route::get('/user', 'UserController@index');
Route::get('/phone', 'PhoneController@index');
Route::get('/post', 'PostController@index');
Route::get('/comment', 'CommentController@index');
Route::get('/role', 'RoleController@index');
Route::get('/country', 'CountryController@index');
Route::get('/video', 'VideoController@index');
Route::get('/tag', 'TagController@index');
Route::get('/book', 'BookController@index');
Route::get('/author', 'AuthorController@index');
Route::get('/publisher', 'PublisherController@index');
Route::get('/contact', 'ContactController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
	Route::get('/', 'AdminController@index');
});

Route::get('/', function () {
	return view('welcome');
	// var_dump(Auth::user()->can("create-*"));
	// var_dump(Auth::user()->hasRole('admin'));
	// var_dump(Auth::user()->can('create-post'));
	// $user = App\User::find(1);
	// var_dump($user->hasRole(['admin', 'owner'], true)); // false
	// var_dump($user->can(['create-post', 'edit-user'], true)); // false
})->name('homepage');

Route::group(['prefix' => '/api/v1', 'middleware' => 'auth:api'], function () {
	Route::get('/users', function () {
		return Auth::guard('api')->user();
	});

	Route::get('/flights', function () {
		return Flight::all();
	});
});

Route::get('/search/create', 'SearchController@create');
Route::get('/search', 'SearchController@index');
Route::get('/search/{keyword}', 'SearchController@search');
Route::post('/search/publish', 'SearchController@publish');

Route::get('auth/github', 'Auth\AuthController@redirectToGithub');
Route::get('auth/github/callback', 'Auth\AuthController@handleGithubCallback');

Route::get('auth/weixinweb', 'Auth\AuthController@redirectToWeixinWeb');
Route::get('auth/weixinweb/callback', 'Auth\AuthController@handleWeixinWebCallback');

Route::get('auth/qq', 'Auth\AuthController@redirectToQQ');
Route::get('auth/qq/callback', 'Auth\AuthController@handleQQCallback');

Route::get('auth/weibo', 'Auth\AuthController@redirectToWeibo');
Route::get('auth/weibo/callback', 'Auth\AuthController@handleWeiboCallback');