<?php

namespace Alrez\IranProvinces\Traits;

use Alrez\IranProvinces\Models\City;
use Alrez\IranProvinces\Models\State;

trait HasCitiesAndStates
{
    public function getStates()
    {
        return State::all();
    }

    public function getCitiesByState($stateId)
    {
        return City::where('state_id', $stateId)->get();
    }
}