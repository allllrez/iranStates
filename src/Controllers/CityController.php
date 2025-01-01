<?php

namespace Alrez\IranStates\Controllers;

use Alrez\IranStates\Models\City;





class CityController
{
    public function index()
    {
        return City::all();
    }
}