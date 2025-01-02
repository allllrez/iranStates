<?php

// src/Services/CityStateService.php
namespace Alrez\IranStates\Services;

use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;
use Illuminate\Support\Facades\Cache;

class CityStateService
{
    const CACHE_TTL = 86400; // 24 hours
    const CACHE_KEY_STATES = 'iran_states.states';
    const CACHE_KEY_CITIES = 'iran_states.cities.state_';

    public function getAllStates()
    {
        return Cache::remember(self::CACHE_KEY_STATES, self::CACHE_TTL, function () {
            return State::all();
        });
    }

    public function getAllStatesWithCities()
    {
        return Cache::remember(self::CACHE_KEY_STATES . '_with_cities', self::CACHE_TTL, function () {
            return State::with('cities')->get();
        });
    }

    public function getStateById($id)
    {
        return Cache::remember(self::CACHE_KEY_STATES . '_' . $id, self::CACHE_TTL, function () use ($id) {
            return State::findOrFail($id);
        });
    }

    public function getCitiesByStateId($stateId)
    {
        return Cache::remember(self::CACHE_KEY_CITIES . $stateId, self::CACHE_TTL, function () use ($stateId) {
            return City::where('state_id', $stateId)->get();
        });
    }

    public function getCityById($id)
    {
        return City::findOrFail($id);
    }

    public function searchCities($query)
    {
        return City::where('name', 'LIKE', "%{$query}%")->get();
    }

    public function searchStates($query)
    {
        return State::where('name', 'LIKE', "%{$query}%")->get();
    }

    public function clearCache()
    {
        Cache::forget(self::CACHE_KEY_STATES);
        Cache::forget(self::CACHE_KEY_STATES . '_with_cities');
        
        // Clear cache for all states
        $states = State::all();
        foreach ($states as $state) {
            Cache::forget(self::CACHE_KEY_STATES . '_' . $state->id);
            Cache::forget(self::CACHE_KEY_CITIES . $state->id);
        }
    }
}
