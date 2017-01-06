<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		\SocialiteProviders\Manager\SocialiteWasCalled::class => [
			// add your listeners (aka providers) here
			'SocialiteProviders\WeixinWeb\WeixinWebExtendSocialite@handle',
			'SocialiteProviders\QQ\QQExtendSocialite@handle',
			'SocialiteProviders\Weibo\WeiboExtendSocialite@handle',
		],
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot() {
		parent::boot();
	}
}
