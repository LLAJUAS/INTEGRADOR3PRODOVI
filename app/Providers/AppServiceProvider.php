<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FacebookService;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
   public function register()
{
    $this->app->singleton(FacebookService::class, function ($app) {
        return new FacebookService();
    });
}

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    Schema::defaultStringLength(191);
}
}
