<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
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
        $mainPath = database_path('migrations');
        $directories = [
            $mainPath . '/locations',
            $mainPath . '/users',
            $mainPath . '/roles',
            $mainPath . '/menu',
            $mainPath . '/empresa',
            $mainPath . '/pharmacy',
            $mainPath . '/store',
        ];
        $paths = array_merge([$mainPath], $directories);

        $this->loadMigrationsFrom($paths);
    }
}
