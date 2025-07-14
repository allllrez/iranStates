<?php

namespace Alrez\IranStates\Traits;

use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractWithState
{
    /**
     * Define relationship to a single state
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the state by ID
     *
     * @param int $stateId
     * @return State|null
     */
    public function getStateById(int $stateId): ?State
    {
        return State::find($stateId);
    }

    /**
     * Get cities belonging to a specific state
     *
     * @param int $stateId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCitiesByState(int $stateId)
    {
        return City::where('state_id', $stateId)->get();
    }

    /**
     * Check if belongs to a specific state
     *
     * @param int $stateId
     * @return bool
     */
    public function belongsToState(int $stateId): bool
    {
        return $this->state_id === $stateId;
    }
}