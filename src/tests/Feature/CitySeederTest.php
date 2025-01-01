<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Src\CityState\Models\City;

class CitySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_city_seeder_populates_database()
    {
        $this->seed(\App\CityState\Resources\Seeders\CityStateSeeder::class);

        $this->assertDatabaseHas('cities', ['name' => 'تهران']);
    }
}
