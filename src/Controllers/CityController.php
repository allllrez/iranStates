<?php

namespace Alrez\IranStates\Controllers;

use Alrez\IranProvinces\Models\City;



class CityController
{
    public function index()
    {
        return City::all();
    }
}