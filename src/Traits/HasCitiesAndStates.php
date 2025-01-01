<?php

namespace Alrez\IranStates\Traits;

use Alrez\IranStates\Models\City;
use Alrez\IranStates\Models\State;

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