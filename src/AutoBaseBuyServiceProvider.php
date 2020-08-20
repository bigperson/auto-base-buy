<?php

namespace Bigperson\AutoBaseBuy;

use basebuy\basebuyAutoApi\BasebuyAutoApi;
use basebuy\basebuyAutoApi\connectors\CurlGetConnector;
use Bigperson\AutoBaseBuy\Console\Commands\AutoBaseBuyUpdate;
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
        $this->registerConfig();
        $this->registerCommands();
        $this->app->singleton(BasebuyAutoApi::class, function ($app) {
            return new BasebuyAutoApi(
                new CurlGetConnector($app['config']['auto-base-buy']['api_key'])
            );
        });
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(
            $this->getConfigPath(),
            'auto-base-buy'
        );
    }

    private function registerCommands()
    {
        $this->commands([
            AutoBaseBuyUpdate::class
        ]);
    }

    /**
     * @return string
     */
    private function getConfigPath()
    {
        return __DIR__ . '/../config/auto-base-buy.php';
    }
}
