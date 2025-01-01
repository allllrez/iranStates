<?php

// src/Services/CityStateService.php
namespace Alrez\IranProvinces\Services;

use Alrez\IranProvinces\Models\State;
use Alrez\IranProvinces\Models\City;

class CityStateService
{
    public function getAllStatesWithCities()
    {
        return State::with('cities')->get();
    }
}
