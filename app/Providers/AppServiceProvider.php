<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AdminService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('admin', function ($app) {
            return new AdminService();
        });
    }

    public function boot(): void
    {
        //
    }
}
