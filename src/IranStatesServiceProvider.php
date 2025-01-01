<?php

namespace Alrez\IranStates;

use Illuminate\Support\ServiceProvider;

class IranStatesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/iran_states.php', 'iran-states');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/iran_states.php' => config_path('iran-states.php'),
                __DIR__ . '/Controllers/CityController.php' => app_path('Http/Controllers/CityController.php'),
                __DIR__ . '/Controllers/StateController.php' => app_path('Http/Controllers/StateController.php'),
                __DIR__ . '/database/json/states.json' => database_path('iran-states/states.json'),
                __DIR__ . '/database/json/cities.json' => database_path('iran-states/cities.json'),
            ], 'iran-states');

            $this->publishes([
                __DIR__ . '/database/migrations/' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__ . '/database/seeders/' => database_path('seeders'),
            ], 'seeders');

            $this->commands([
                \Alrez\IranStates\Console\InstallCommand::class,
            ]);
        }
    }
}