<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Http\Controllers\Controller;
use Socialite;

class AuthController extends Controller {
	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @return Response
	 */
	public function redirectToGithub() {
		return Socialite::driver('github')->redirect();
	}

	/**
	 * Redirect the user to the weixinweb authentication page.
	 *
	 * @return Response
	 */
	public function redirectToWeixinWeb() {
		return Socialite::with('weixinweb')->redirect();
	}

	/**
	 * Redirect the user to the qq authentication page.
	 *
	 * @return Response
	 */
	public function redirectToQQ() {
		return Socialite::with('qq')->redirect();
	}

	/**
	 * Redirect the user to the weibo authentication page.
	 *
	 * @return Response
	 */
	public function redirectToWeibo() {
		return Socialite::with('weibo')->redirect();
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function handleGithubCallback() {
		$user = Socialite::driver('github')->user();

		$countries = Country::all();

		return view('auth/register', compact('user', 'countries'));
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function handleWeixinWebCallback() {
		$user = Socialite::driver('weixinweb')->user();

		$countries = Country::all();

		return view('auth/register', compact('user', 'countries'));
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function handleQQCallback() {
		$user = Socialite::driver('qq')->user();

		$countries = Country::all();

		return view('auth/register', compact('user', 'countries'));
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function handleWeiboCallback() {
		$user = Socialite::driver('weibo')->user();

		$countries = Country::all();

		return view('auth/register', compact('user', 'countries'));
	}
}