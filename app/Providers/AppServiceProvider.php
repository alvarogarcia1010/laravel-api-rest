<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
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
        if (env('REDIRECT_HTTPS'))
        {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env('REDIRECT_HTTPS'))
        {
            $url->formatScheme('https://');
        }

        $this->registerUserInterface();
        $this->registerArticleInterface();
        $this->registerBaptismInterface();
        $this->registerConfirmationInterface();
        $this->registerMarriageInterface();

        $this->registerAuthenticationManagementInterface();
        $this->registerUserManagementInterface();
        $this->registerArticleManagementInterface();
        $this->registerBaptismManagementInterface();
        $this->registerConfirmationManagementInterface();
        $this->registerMarriageManagementInterface();
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
	* Register a baptism interface instance.
	*
	* @return void
	*/
	protected function registerBaptismInterface()
	{
		$this->app->bind('App\Repositories\Baptism\BaptismInterface', function($app)
		{
			return new \App\Repositories\Baptism\EloquentBaptism(new \App\Models\Baptism());
		});
    }

    /**
	* Register a confirmation interface instance.
	*
	* @return void
	*/
	protected function registerConfirmationInterface()
	{
		$this->app->bind('App\Repositories\Confirmation\ConfirmationInterface', function($app)
		{
			return new \App\Repositories\Confirmation\EloquentConfirmation(new \App\Models\Confirmation());
		});
    }

    /**
	* Register a marriage interface instance.
	*
	* @return void
	*/
	protected function registerMarriageInterface()
	{
		$this->app->bind('App\Repositories\Marriage\MarriageInterface', function($app)
		{
			return new \App\Repositories\Marriage\EloquentMarriage(new \App\Models\Marriage());
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
	* Register a user manager interface instance.
	*
	* @return void
	*/
	protected function registerUserManagementInterface()
	{
		$this->app->bind('App\Services\UserManager\UserManagementInterface', function($app)
		{
			return new \App\Services\UserManager\UserManager(
                $app->make('App\Repositories\User\UserInterface'),
                new Carbon()
            );
		});
	}

    /**
	* Register a article manager interface instance.
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

    /**
	* Register a baptism manager interface instance.
	*
	* @return void
	*/
	protected function registerBaptismManagementInterface()
	{
		$this->app->bind('App\Services\BaptismManager\BaptismManagementInterface', function($app)
		{
			return new \App\Services\BaptismManager\BaptismManager(
                $app->make('App\Repositories\Baptism\BaptismInterface'),
                new Carbon()
            );
		});
	}

    /**
	* Register a confirmation manager interface instance.
	*
	* @return void
	*/
	protected function registerConfirmationManagementInterface()
	{
		$this->app->bind('App\Services\ConfirmationManager\ConfirmationManagementInterface', function($app)
		{
			return new \App\Services\ConfirmationManager\ConfirmationManager(
                $app->make('App\Repositories\Confirmation\ConfirmationInterface'),
                new Carbon()
            );
		});
	}

    /**
	* Register a marriage manager interface instance.
	*
	* @return void
	*/
	protected function registerMarriageManagementInterface()
	{
		$this->app->bind('App\Services\MarriageManager\MarriageManagementInterface', function($app)
		{
			return new \App\Services\MarriageManager\MarriageManager(
                $app->make('App\Repositories\Marriage\MarriageInterface'),
                new Carbon()
            );
		});
	}
}

