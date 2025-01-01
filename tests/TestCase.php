<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Alrez\IranProvinces\Models\City;
use Alrez\IranProvinces\Models\State;

class TestCase extends BaseTestCase
{
    public function test_package_is_installed()
    {
        $this->assertTrue(class_exists(City::class));
        $this->assertTrue(class_exists(State::class));
    }

    public function test_publish_controller_provider_and_json()
    {
        Artisan::call('vendor:publish', ['--tag' => 'iran-provinces']);

        $this->assertFileExists(config_path('iran-provinces.php'));
        $this->assertFileExists(app_path('Http/Controllers/IranProvincesController.php'));
        $this->assertFileExists(database_path('iran-provinces/states.json'));
    }

    public function test_publish_migrations_and_seeders()
    {
        Artisan::call('vendor:publish', ['--tag' => 'migrations']);
        Artisan::call('vendor:publish', ['--tag' => 'seeders']);

        $this->assertFileExists(database_path('migrations/2023_01_01_000000_create_states_table.php'));
        $this->assertFileExists(database_path('migrations/2023_01_01_000001_create_cities_table.php'));
        $this->assertFileExists(database_path('seeders/StatesTableSeeder.php'));
        $this->assertFileExists(database_path('seeders/CitiesTableSeeder.php'));
    }

    public function test_migrations_and_seeders_run_correctly()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');

        $this->assertGreaterThan(0, State::count());
        $this->assertGreaterThan(0, City::count());
    }

    public function test_access_to_cities_and_states()
    {
        $state = State::first();
        $this->assertNotNull($state);

        $city = City::first();
        $this->assertNotNull($city);
    }
}