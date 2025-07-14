<?php

// src/Services/CityStateService.php
namespace Alrez\IranStates\Services;

use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class CityStateService
{
    const CACHE_TTL = 86400; // 24 hours
    const CACHE_KEY_STATES = 'iran_states.states';
    const CACHE_KEY_CITIES = 'iran_states.cities.state_';

    /**
     * Get all states (use this only when you need the full list)
     * For better performance, consider using specific state queries when possible
     *
     * @return Collection
     */
    public function getAllStates(): Collection
    {
        return Cache::remember(self::CACHE_KEY_STATES, self::CACHE_TTL, function () {
            return State::all();
        });
    }

    /**
     * Get all states with their cities (use sparingly as this loads everything)
     * Recommended for dropdown/select components that need complete data
     *
     * @return Collection
     */
    public function getAllStatesWithCities(): Collection
    {
        return Cache::remember(self::CACHE_KEY_STATES . '_with_cities', self::CACHE_TTL, function () {
            return State::with('cities')->get();
        });
    }

    /**
     * Get a specific state by ID (optimized for single state queries)
     *
     * @param int $id
     * @return State
     */
    public function getStateById(int $id): State
    {
        return Cache::remember(self::CACHE_KEY_STATES . '_' . $id, self::CACHE_TTL, function () use ($id) {
            return State::findOrFail($id);
        });
    }

    /**
     * Get a specific state with its cities by ID
     *
     * @param int $id
     * @return State
     */
    public function getStateWithCitiesById(int $id): State
    {
        return Cache::remember(self::CACHE_KEY_STATES . '_with_cities_' . $id, self::CACHE_TTL, function () use ($id) {
            return State::with('cities')->findOrFail($id);
        });
    }

    /**
     * Get cities by state ID (preferred method for getting cities)
     *
     * @param int $stateId
     * @return Collection
     */
    public function getCitiesByStateId(int $stateId): Collection
    {
        return Cache::remember(self::CACHE_KEY_CITIES . $stateId, self::CACHE_TTL, function () use ($stateId) {
            return City::where('state_id', $stateId)->get();
        });
    }

    /**
     * Get a specific city by ID
     *
     * @param int $id
     * @return City
     */
    public function getCityById(int $id): City
    {
        return Cache::remember('iran_states.city_' . $id, self::CACHE_TTL, function () use ($id) {
            return City::findOrFail($id);
        });
    }

    /**
     * Search cities by name
     *
     * @param string $query
     * @return Collection
     */
    public function searchCities(string $query): Collection
    {
        return City::where('name', 'LIKE', "%{$query}%")->get();
    }

    /**
     * Search states by name
     *
     * @param string $query
     * @return Collection
     */
    public function searchStates(string $query): Collection
    {
        return State::where('name', 'LIKE', "%{$query}%")->get();
    }

    /**
     * Get states by multiple IDs (for batch operations)
     *
     * @param array $stateIds
     * @return Collection
     */
    public function getStatesByIds(array $stateIds): Collection
    {
        return Cache::remember('iran_states.states_' . md5(implode(',', $stateIds)), self::CACHE_TTL, function () use ($stateIds) {
            return State::whereIn('id', $stateIds)->get();
        });
    }

    /**
     * Get cities by multiple state IDs (for batch operations)
     *
     * @param array $stateIds
     * @return Collection
     */
    public function getCitiesByStateIds(array $stateIds): Collection
    {
        return Cache::remember('iran_states.cities_multiple_' . md5(implode(',', $stateIds)), self::CACHE_TTL, function () use ($stateIds) {
            return City::whereIn('state_id', $stateIds)->get();
        });
    }

    /**
     * Clear all cache for the service
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY_STATES);
        Cache::forget(self::CACHE_KEY_STATES . '_with_cities');

        // Clear cache for all states
        $states = State::all();
        foreach ($states as $state) {
            Cache::forget(self::CACHE_KEY_STATES . '_' . $state->id);
            Cache::forget(self::CACHE_KEY_STATES . '_with_cities_' . $state->id);
            Cache::forget(self::CACHE_KEY_CITIES . $state->id);
            Cache::forget('iran_states.city_' . $state->id);
        }

        // Clear pattern-based cache keys
        $cacheKeys = Cache::getRedis()->keys('iran_states.*');
        if (!empty($cacheKeys)) {
            Cache::getRedis()->del($cacheKeys);
        }
    }

    /**
     * Get total count of states
     *
     * @return int
     */
    public function getStatesCount(): int
    {
        return Cache::remember('iran_states.states_count', self::CACHE_TTL, function () {
            return State::count();
        });
    }

    /**
     * Get total count of cities
     *
     * @return int
     */
    public function getCitiesCount(): int
    {
        return Cache::remember('iran_states.cities_count', self::CACHE_TTL, function () {
            return City::count();
        });
    }
}