<?php

namespace BigInteger\LaravelInstaller;

use Illuminate\Support\ServiceProvider;

class InstallerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'installer');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/installer.php' => config_path('installer.php'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/installer'),
        ], 'installer');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/installer.php', 'installer');
    }
} 