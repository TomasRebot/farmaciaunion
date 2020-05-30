<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('delete', function ($expression) {
            return (Auth::check() && Auth::user()->can($expression.'.delete'));
        });
        Blade::if('create', function ($expression) {
            return (Auth::check() && Auth::user()->can($expression.'.create'));
        });
        Blade::if('update', function ($expression) {
            return (Auth::check() && Auth::user()->can($expression.'.update'));
        });
        Blade::if('view', function ($expression) {
            return (Auth::check() && Auth::user()->can($expression.'.view'));
        });

    }
}



