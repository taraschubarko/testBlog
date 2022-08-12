<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageFServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Services\Contracts\ImageFServiceInterface::class,
            \App\Services\ImageFService::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('imageF', \App\Services\ImageFService::class);
    }
}
