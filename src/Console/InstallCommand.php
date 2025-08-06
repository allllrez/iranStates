<?php

namespace Alrez\IranStates\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Installation Command for Iran States Package
 * 
 * This command handles the installation process of the Iran States package,
 * including running migrations and seeding the database with states and cities data.
 */
class InstallCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'iranStates:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Iran States package with migrations and seeders';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Installing Iran States Package...');

        // Run migrations directly
        $this->info('Running migrations...');
        Artisan::call('migrate', [
            '--path' => 'vendor/alrez/iran-states/src/database/migrations'
        ]);

        // Run seeders using require_once to avoid autoload issues
        $this->info('Seeding database with states and cities...');

        // Load and run StatesTableSeeder
        require_once __DIR__ . '/../database/seeders/StatesTableSeeder.php';
        $statesSeeder = new \Alrez\IranStates\Database\Seeders\StatesTableSeeder();
        $statesSeeder->run();

        // Load and run CitiesTableSeeder
        require_once __DIR__ . '/../database/seeders/CitiesTableSeeder.php';
        $citiesSeeder = new \Alrez\IranStates\Database\Seeders\CitiesTableSeeder();
        $citiesSeeder->run();

        $this->info('Iran States package installed successfully.');
    }
}
