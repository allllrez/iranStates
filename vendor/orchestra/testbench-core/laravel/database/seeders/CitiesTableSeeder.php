<?php

namespace Alrez\IranProvinces\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $cities = json_decode(file_get_contents(__DIR__ . '/../json/cities.json'), true);

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'id' => $city['id'],
                'name' => $city['name'],
                'slug' => $city['slug'],
                'state_id' => $city['province_id']
            ]);
        }
    }
}