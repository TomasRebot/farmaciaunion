<?php

namespace App\Providers;

use App\GlobalConfig;
use Illuminate\Support\ServiceProvider;

class GlobalConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('globalconfig', function ($app) {
            return (new GlobalConfig())->first();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
