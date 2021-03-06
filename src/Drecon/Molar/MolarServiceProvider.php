<?php namespace Drecon\Molar;

use Illuminate\Support\ServiceProvider;
use Drecon\Molar\Commands\SetUpCommand;
use Drecon\Molar\Commands\ViewsCommand;
use Drecon\Molar\Commands\ControllerCommand;

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

		$this->registerController();
		$this->commands('commands.molar.controller');
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

	protected function registerController()
	{
		$this->app['commands.molar.controller'] = $this->app->share(function($app)
	    {
	        return new ControllerCommand;
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