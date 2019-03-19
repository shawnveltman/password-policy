<?php

namespace Simplesales\PasswordPolicy;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Simplesales\PasswordPolicy\Http\Controllers\PasswordPolicyController;

class PasswordPolicyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'password-policy');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'password-policy');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if ($this->app->runningInConsole())
        {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('password-policy.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/password-policy'),
            ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/password-policy'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/password-policy'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'password-policy');

        // Register the main class to use with the facade
        $this->app->singleton('password-policy', function () {
            return new PasswordPolicy;
        });
    }
}
