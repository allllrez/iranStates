<?php

namespace Tests\Unit;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Artisan;
use Alrez\IranProvinces\Models\City;
use Alrez\IranProvinces\Models\State;
use Alrez\IranProvinces\IranStatesServiceProvider;
use Alrez\IranProvinces\Database\Seeders\StatesTableSeeder;
use Alrez\IranProvinces\Database\Seeders\CitiesTableSeeder;

class InstallationTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            IranStatesServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        
        // Run migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../src/database/migrations');
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    public function test_package_is_installed()
    {
        $this->assertTrue(class_exists(City::class));
        $this->assertTrue(class_exists(State::class));
    }

    public function test_publish_controller_provider_and_json()
    {
        $this->artisan('vendor:publish', ['--tag' => 'iran-provinces'])->run();

        $this->assertFileExists($this->app->basePath('config/iran-provinces.php'));
        $this->assertFileExists($this->app->basePath('app/Http/Controllers/CityController.php'));
        $this->assertFileExists($this->app->basePath('app/Http/Controllers/StateController.php'));
        $this->assertFileExists($this->app->basePath('database/iran-provinces/states.json'));
        $this->assertFileExists($this->app->basePath('database/iran-provinces/cities.json'));
    }

    public function test_publish_migrations_and_seeders()
    {
        $this->artisan('vendor:publish', ['--tag' => 'migrations'])->run();
        $this->artisan('vendor:publish', ['--tag' => 'seeders'])->run();

        $this->assertFileExists($this->app->basePath('database/migrations/2025_01_01_000000_create_states_table.php'));
        $this->assertFileExists($this->app->basePath('database/migrations/2025_01_01_000001_create_cities_table.php'));
        $this->assertFileExists($this->app->basePath('database/seeders/StatesTableSeeder.php'));
        $this->assertFileExists($this->app->basePath('database/seeders/CitiesTableSeeder.php'));
    }

    public function test_migrations_and_seeders_run_correctly()
    {
        $this->seed(StatesTableSeeder::class);
        $this->seed(CitiesTableSeeder::class);

        $this->assertGreaterThan(0, State::count());
        $this->assertGreaterThan(0, City::count());
    }

    public function test_access_to_cities_and_states()
    {
        $this->seed(StatesTableSeeder::class);
        $this->seed(CitiesTableSeeder::class);

        $state = State::first();
        $this->assertNotNull($state);

        $city = City::first();
        $this->assertNotNull($city);
    }
} 