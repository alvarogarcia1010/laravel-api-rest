<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerUserInterface();
        $this->registerAuthenticationManagementInterface();
    }

    /**
	* Register a user interface instance.
	*
	* @return void
	*/
	protected function registerUserInterface()
	{
		$this->app->bind('App\Repositories\User\UserInterface', function($app)
		{
			return new \App\Repositories\User\EloquentUser(new \App\Models\User());
		});
    }

    /**
	* Register a user interface instance.
	*
	* @return void
	*/
	protected function registerAuthenticationManagementInterface()
	{
		$this->app->bind('App\Services\AuthenticationManager\AuthenticationManagementInterface', function($app)
		{
			return new \App\Services\AuthenticationManager\AuthenticationManager(
                $app->make('App\Repositories\User\UserInterface'),
                new Carbon()
            );
		});
	}
}

