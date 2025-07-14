<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Alrez\IranStates\Database\Seeders\StatesTableSeeder;
use Alrez\IranStates\Database\Seeders\CitiesTableSeeder;

class SeedersTest extends TestCase
{
    /** @test */
    public function it_has_states_seeder_class()
    {
        // بررسی که کلاس StatesTableSeeder وجود دارد
        $this->assertTrue(class_exists(StatesTableSeeder::class));
    }

    /** @test */
    public function it_has_cities_seeder_class()
    {
        // بررسی که کلاس CitiesTableSeeder وجود دارد
        $this->assertTrue(class_exists(CitiesTableSeeder::class));
    }

    /** @test */
    public function seeders_have_run_method()
    {
        // بررسی که seeders دارای متد run هستند
        $statesSeeder = new StatesTableSeeder();
        $this->assertTrue(method_exists($statesSeeder, 'run'));

        $citiesSeeder = new CitiesTableSeeder();
        $this->assertTrue(method_exists($citiesSeeder, 'run'));
    }

    /** @test */
    public function seeders_extend_correct_base_class()
    {
        // بررسی که seeders از کلاس صحیح extend می‌کنند
        $statesSeeder = new StatesTableSeeder();
        $this->assertInstanceOf('Illuminate\Database\Seeder', $statesSeeder);

        $citiesSeeder = new CitiesTableSeeder();
        $this->assertInstanceOf('Illuminate\Database\Seeder', $citiesSeeder);
    }

    /** @test */
    public function json_data_files_exist()
    {
        // بررسی که فایل‌های JSON داده وجود دارند
        $statesJsonPath = __DIR__ . '/../../src/database/json/states.json';
        $citiesJsonPath = __DIR__ . '/../../src/database/json/cities.json';

        $this->assertFileExists($statesJsonPath);
        $this->assertFileExists($citiesJsonPath);
    }

    /** @test */
    public function json_data_files_are_valid_json()
    {
        // بررسی که فایل‌های JSON معتبر هستند
        $statesJsonPath = __DIR__ . '/../../src/database/json/states.json';
        $citiesJsonPath = __DIR__ . '/../../src/database/json/cities.json';

        $statesData = json_decode(file_get_contents($statesJsonPath), true);
        $citiesData = json_decode(file_get_contents($citiesJsonPath), true);

        $this->assertIsArray($statesData);
        $this->assertIsArray($citiesData);
        $this->assertGreaterThan(0, count($statesData));
        $this->assertGreaterThan(0, count($citiesData));
    }

    /** @test */
    public function json_data_has_required_fields()
    {
        // بررسی که داده‌های JSON دارای فیلدهای لازم هستند
        $statesJsonPath = __DIR__ . '/../../src/database/json/states.json';
        $citiesJsonPath = __DIR__ . '/../../src/database/json/cities.json';

        $statesData = json_decode(file_get_contents($statesJsonPath), true);
        $citiesData = json_decode(file_get_contents($citiesJsonPath), true);

        // بررسی فیلدهای استان
        if (!empty($statesData)) {
            $firstState = $statesData[0];
            $this->assertArrayHasKey('id', $firstState);
            $this->assertArrayHasKey('name', $firstState);
            $this->assertArrayHasKey('slug', $firstState);
        }

        // بررسی فیلدهای شهر
        if (!empty($citiesData)) {
            $firstCity = $citiesData[0];
            $this->assertArrayHasKey('id', $firstCity);
            $this->assertArrayHasKey('name', $firstCity);
            $this->assertArrayHasKey('slug', $firstCity);
            $this->assertTrue(
                array_key_exists('province_id', $firstCity) ||
                    array_key_exists('state_id', $firstCity)
            );
        }
    }
}
