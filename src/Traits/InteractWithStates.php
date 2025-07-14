<?php

namespace Alrez\IranStates\Traits;

use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

trait InteractWithStates
{
    /**
     * Define relationship to multiple states (if applicable)
     *
     * @return HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get all states
     *
     * @return Collection
     */
    public function getAllStates(): Collection
    {
        return State::all();
    }

    /**
     * Get all states with their cities
     *
     * @return Collection
     */
    public function getAllStatesWithCities(): Collection
    {
        return State::with('cities')->get();
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
     * Get states by multiple IDs
     *
     * @param array $stateIds
     * @return Collection
     */
    public function getStatesByIds(array $stateIds): Collection
    {
        return State::whereIn('id', $stateIds)->get();
    }

    /**
     * Get cities from multiple states
     *
     * @param array $stateIds
     * @return Collection
     */
    public function getCitiesFromStates(array $stateIds): Collection
    {
        return City::whereIn('state_id', $stateIds)->get();
    }

    /**
     * Get total count of all states
     *
     * @return int
     */
    public function getStatesCount(): int
    {
        return State::count();
    }
}
