<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AuthService;
use App\Services\UserEntityService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the AuthService
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService();
        });

         // Register the UserEntityService with AuthService injected
         $this->app->singleton(UserEntityService::class, function ($app) {
            return new UserEntityService($app->make(AuthService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
