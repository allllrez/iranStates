<?php

namespace Alrez\IranStates\Traits;

use Illuminate\Support\Facades\Validator;

/**
 * Trait ValidationRules
 * 
 * Provides validation rules for states and cities.
 */
trait ValidationRules
{
    /**
     * Get validation rules for a state.
     *
     * @return array The validation rules for a state.
     */
    public static function getStateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:states,slug',
        ];
    }

    /**
     * Get validation rules for a city.
     *
     * @return array The validation rules for a city.
     */
    public static function getCityRules(): array
    {
        return [
            'name' => 'required|string|max:255', 
            'slug' => 'required|string|max:255|unique:cities,slug',
            'state_id' => 'required|exists:states,id',
        ];
    }
}