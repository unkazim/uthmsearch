<?php

namespace App\Providers;

use App\Services\AdminService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AdminService::class, function ($app) {
            return new AdminService();
        });
    }

    public function boot(): void
    {
        //
    }
}
