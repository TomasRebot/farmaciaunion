<?php

namespace App\Providers;

use App\Core\Entities\Menu;

use App\Entities\Form;
use App\Entities\Module;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('menu', function ($app) {
            return new \App\Core\Entities\Menu(new Module(), new Form());
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
