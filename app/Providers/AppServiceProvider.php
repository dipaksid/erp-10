<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DataService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DataService::class, function ($app) {
            return new DataService();
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
