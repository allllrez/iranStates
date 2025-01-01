<?php

namespace App\CityState\Controllers;

use App\CityState\Models\City;

class CityController
{
    public function index()
    {
        return City::all();
    }
}