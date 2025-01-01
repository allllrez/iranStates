<?php

namespace Alrez\IranStates\Controllers;

use Alrez\IranProvinces\Models\State;




class StateController
{
    public function index()
    {
        return State::with('cities')->get();
    }
}