<?php

namespace Alrez\IranStates;

use Illuminate\Support\ServiceProvider;

/**
 * Iran States Service Provider
 * 
 * This service provider handles the registration and booting of the Iran States package.
 * It provides functionality for managing Iranian states and cities data.
 */
class IranStatesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/iran_states.php', 'iran-states');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Register the installation command
            $this->commands([
                Console\InstallCommand::class,
            ]);

            // Publish config file
            $this->publishes([
                __DIR__ . '/../config/iran_states.php' => config_path('iran-states.php'),
            ], 'iran-states');
        }
    }
}