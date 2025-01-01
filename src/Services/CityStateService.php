<?php

// src/Services/CityStateService.php
namespace Alrez\IranStates\Services;

use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;

class CityStateService
{
    public function getAllStatesWithCities()
    {
        return State::with('cities')->get();
    }
}
