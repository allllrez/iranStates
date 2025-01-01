<?php

namespace App\CityState\Controllers;

namespace App\CityState\Controllers;

use App\CityState\Models\State;

class StateController
{
    public function index()
    {
        return State::with('cities')->get();
    }
}