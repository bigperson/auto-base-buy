<?php

namespace Bigperson\AutoBaseBuy;

use basebuy\basebuyAutoApi\BasebuyAutoApi;
use basebuy\basebuyAutoApi\connectors\CurlGetConnector;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(BasebuyAutoApi::class, function ($app) {
//            return new BasebuyAutoApi(
//                new CurlGetConnector($app['config']['auto-base-buy']['api_key'])
//            );
//        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [BasebuyAutoApi::class];
    }
}
