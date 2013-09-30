<?php namespace Drecon\Molar;

use Illuminate\Support\ServiceProvider;
use Drecon\Molar\Commands\SetUpCommand;
use Drecon\Molar\Commands\ViewsCommand;

class MolarServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('drecon/molar');
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Molar', 'Drecon\Molar\Facades\Molar');
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['molar'] = $this->app->share(function($app)
		{
			return new Molar;
		});

		$this->registerSetUp();
		$this->commands('commands.molar.setup');

		$this->registerViews();
		$this->commands('commands.molar.views');
	}

	protected function registerSetUp()
	{
		$this->app['commands.molar.setup'] = $this->app->share(function($app)
	    {
	        return new SetUpCommand;
	    });
	}

	protected function registerViews()
	{
		$this->app['commands.molar.views'] = $this->app->share(function($app)
	    {
	        return new ViewsCommand;
	    });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('molar');
	}

}