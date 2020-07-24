<?php

namespace Goodechilde\Arche;

use Goodechilde\Arche\Console\Commands\SeederMakeCommand;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\ServiceProvider;
use Goodechilde\Arche\Console\Commands\ControllerMakeCommand;
use Goodechilde\Arche\Console\Commands\FactoryMakeCommand;
use Goodechilde\Arche\Console\Commands\Arche;
use Goodechilde\Arche\Console\Commands\MigrateMakeCommand;
use Goodechilde\Arche\Console\Commands\ModelMakeCommand;
use Goodechilde\Arche\Console\Commands\RequestMakeCommand;

class ArcheServiceProvider extends ServiceProvider
{

    protected $commands = [
        ControllerMakeCommand::class,
        FactoryMakeCommand::class,
        Arche::class,
        MigrateMakeCommand::class,
        ModelMakeCommand::class,
        RequestMakeCommand::class,
        SeederMakeCommand::class,
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'arche');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'arche');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

//        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('arche.php'),
            ], 'arche');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/arche'),
            ], 'views');*/

            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../resources/stubs' => resource_path('stubs')
            ], 'arche');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/arche'),
            ], 'lang');*/

        $this->app->when(MigrationCreator::class)
            ->needs('$customStubPath')
            ->give(function ($app) {
                return resource_path('stubs');
            });

            // Registering package commands.
            $this->commands($this->commands);
//        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'arche');

        // Register the main class to use with the facade
        $this->app->singleton('arche', function () {
            return new Arche;
        });
    }
}
