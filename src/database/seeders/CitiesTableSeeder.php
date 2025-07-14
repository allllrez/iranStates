<?php

namespace Alrez\IranStates\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $cities = json_decode(file_get_contents(__DIR__ . '/../json/cities.json'), true);

        // Prepare data for batch insertion
        $cityData = [];
        foreach ($cities as $city) {
            $cityData[] = [
                'id' => $city['id'],
                'name' => $city['name'],
                'slug' => $city['slug'],
                'state_id' => $city['province_id']
            ];
        }

        // Insert in chunks of 1000 for better performance
        Collection::make($cityData)->chunk(1000)->each(function ($chunk) {
            DB::table('cities')->insert($chunk->toArray());
        });
    }
}