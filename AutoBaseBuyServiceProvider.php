<?php

namespace Bigperson\AutoBaseBuy;

use Illuminate\Support\ServiceProvider;

class AutoBaseBuyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/src/config/autobasybuy.php' => config_path('autobasybuy.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/src/database/migrations' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/src/database/seeds' => database_path('seeds')
        ], 'seeds');

        $this->publishes([
            __DIR__.'/src/database/csv' => database_path('csv')
        ], 'seeds');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/src/config/autobasybuy.php', 'autobasybuy'
        );
    }
}
