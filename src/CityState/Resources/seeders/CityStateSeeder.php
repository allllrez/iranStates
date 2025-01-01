<?php

namespace Src\CityState\Resources\Seeders;


use Illuminate\Database\Seeder;
use App\CityState\Models\State;
use App\CityState\Models\City;
class CityStateSeeder extends Seeder
{
    public function run()
    {
        $states = json_decode(file_get_contents(resource_path('city_state/json/states.json')), true);
        $cities = json_decode(file_get_contents(resource_path('city_state/json/cities.json')), true);

        foreach ($states as $state) {
            State::updateOrCreate(['id' => $state['id']], $state);
        }

        foreach ($cities as $city) {
            City::updateOrCreate(['id' => $city['id']], $city);
        }
    }
}
