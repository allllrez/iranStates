<?php

namespace Src\CityState\Traits;

use App\CityState\Models\State;


trait HasCitiesAndStates
{
    public function getStatesWithCities()
    {
        return State::with('cities')->get();
    }
}