<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Third Party Services
		    |--------------------------------------------------------------------------
		    |
		    | This file is for storing the credentials for third party services such
		    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
		    | default location for this type of information, allowing packages
		    | to have a conventional place to find your various credentials.
		    |
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'ses' => [
		'key' => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'sparkpost' => [
		'secret' => env('SPARKPOST_SECRET'),
	],

	'stripe' => [
		'model' => App\User::class,
		'key' => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],

	'github' => [
		'client_id' => '5fe945d36e7460166e9b',
		'client_secret' => 'f38794e9fbdc9d94a7532fede52c42f7e57f9cf7',
		'redirect' => 'http://laravel.com/auth/github/callback',
	],

	'weixinweb' => [
		'client_id' => env('WEIXINWEB_KEY'),
		'client_secret' => env('WEIXINWEB_SECRET'),
		'redirect' => env('WEIXINWEB_REDIRECT_URI'),
	],

	'qq' => [
		'client_id' => env('QQ_KEY'),
		'client_secret' => env('QQ_SECRET'),
		'redirect' => env('QQ_REDIRECT_URI'),
	],

	'weibo' => [
		'client_id' => env('WEIBO_KEY'),
		'client_secret' => env('WEIBO_SECRET'),
		'redirect' => env('WEIBO_REDIRECT_URI'),
	],
];
