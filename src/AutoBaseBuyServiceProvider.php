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
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds'),
        ], 'seeds');

        $this->publishes([
            __DIR__.'/database/csv' => database_path('csv'),
        ], 'seeds');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
