<?php

namespace App\CityState\Services;

use App\CityState\Models\City;
use App\CityState\Models\State;

class CityStateService
{
    public function getAllCities()
    {
        return City::with('state')->get();
    }

    public function getAllStates()
    {
        return State::with('cities')->get();
    }
}