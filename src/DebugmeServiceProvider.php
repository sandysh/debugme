<?php

namespace Sandysh\Debugme;

use Closure;
use Illuminate\Support\ServiceProvider;
use Sandysh\Debugme\Debugme;

class DebugmeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Debugme $debugme)
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'debugme');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'debugme');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('debugme.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/debugme'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/debugme'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/debugme'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }

        $debugme->boot();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'debugme');

        // Register the main class to use with the facade
        $this->app->singleton('debugme', function () {
            return new Debugme;
        });
    }

}
