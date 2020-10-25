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
        $this->registerArticleInterface();
        $this->registerAuthenticationManagementInterface();
        $this->registerArticleManagementInterface();
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
	* Register a article interface instance.
	*
	* @return void
	*/
	protected function registerArticleInterface()
	{
		$this->app->bind('App\Repositories\Article\ArticleInterface', function($app)
		{
			return new \App\Repositories\Article\EloquentArticle(new \App\Models\Article());
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

    /**
	* Register a article interface instance.
	*
	* @return void
	*/
	protected function registerArticleManagementInterface()
	{
		$this->app->bind('App\Services\ArticleManager\ArticleManagementInterface', function($app)
		{
			return new \App\Services\ArticleManager\ArticleManager(
                $app->make('App\Repositories\Article\ArticleInterface'),
                new Carbon()
            );
		});
	}
}

