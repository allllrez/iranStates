<?php

namespace Alrez\IranProvinces;

use Illuminate\Support\ServiceProvider;

class IranStatesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/iran_states.php', 'iran_provinces');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/iran_states.php' => config_path('iran-provinces.php'),
                __DIR__ . '/Controllers/CityController.php' => app_path('Http/Controllers/CityController.php'),
                __DIR__ . '/Controllers/StateController.php' => app_path('Http/Controllers/StateController.php'),
                __DIR__ . '/database/json/states.json' => database_path('iran-provinces/states.json'),
                __DIR__ . '/database/json/cities.json' => database_path('iran-provinces/cities.json'),
            ], 'iran-provinces');

            $this->publishes([
                __DIR__ . '/database/migrations/' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__ . '/database/seeders/' => database_path('seeders'),
            ], 'seeders');

            $this->commands([
                \Alrez\IranProvinces\Console\InstallCommand::class,
            ]);
        }
    }
}