<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Alrez\IranStates\Models\City;
use Alrez\IranStates\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstallationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_run_migrations_and_check_tables()
    {
        // Run migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../src/database/migrations');
        
        // Check if tables exist
        $this->assertTrue(Schema::hasTable('states'));
        $this->assertTrue(Schema::hasTable('cities'));
    }

    /** @test */
    public function it_can_seed_and_check_data()
    {
        // Run migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../src/database/migrations');
        
        // Run seeders
        $this->seed(\Alrez\IranStates\Database\Seeders\StatesTableSeeder::class);
        $this->seed(\Alrez\IranStates\Database\Seeders\CitiesTableSeeder::class);

        // Check if data exists
        $this->assertDatabaseCount('states', 31);
        $this->assertDatabaseCount('cities', 1119);
    }

    /** @test */
    public function it_can_use_models()
    {
        // Run migrations and seeders
        $this->loadMigrationsFrom(__DIR__ . '/../../src/database/migrations');
        $this->seed(\Alrez\IranStates\Database\Seeders\StatesTableSeeder::class);
        $this->seed(\Alrez\IranStates\Database\Seeders\CitiesTableSeeder::class);

        // Test State model
        $state = State::first();
        $this->assertNotNull($state);
        $this->assertIsString($state->name);
        
        // Test City model
        $city = City::first();
        $this->assertNotNull($city);
        $this->assertIsString($city->name);
        
        // Test relationships
        $this->assertInstanceOf(State::class, $city->state);
        $this->assertNotEmpty($state->cities);
    }
}