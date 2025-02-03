<?php

namespace DWK\Switcher;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class SwitcherServiceProvider extends ServiceProvider{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'switcher');
        $this->loadRoutesFrom(__DIR__.'/route.php');

        $this->publishes([
            __DIR__.'/config/switcher.php' => config_path('switcher.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
