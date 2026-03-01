<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Fluent;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Rovota\Embla\Tabs\TabsFacadeProxy;
use Rovota\Embla\Tabs\TabsManager;

class EmblaServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->mergeConfigFrom(
			__DIR__.'/../config/embla.php', 'embla'
		);

		$this->bindTabsFunctionality();
	}

	public function boot(): void
	{
		View::macro('withOverlay', function (string $action, string|null $value = null) {
			\Illuminate\Support\Facades\View::share('trigger_overlay', new Fluent(compact('action', 'value')));
			return $this;
		});

		View::macro('withParent', function (string $action, string|null $value = null) {
			\Illuminate\Support\Facades\View::share('trigger_parent', new Fluent(compact('action', 'value')));
			return $this;
		});

		// -----------------

		$this->publishes([
			__DIR__.'/../resources/styles' => $this->app->publicPath('vendor/embla/styles'),
		], 'embla-styles');

		$this->publishes([
			__DIR__.'/../resources/scripts' => $this->app->publicPath('vendor/embla/scripts'),
		], 'embla-scripts');

		// -----------------

		Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', 'embla');
	}

	// -----------------

	protected function bindTabsFunctionality(): void
	{
		$this->app->singleton(TabsManager::class, function ($app) {
			return new TabsManager();
		});

		$this->app->singleton(TabsFacadeProxy::class, function ($app) {
			return new TabsFacadeProxy($app->make(TabsManager::class));
		});
	}
}