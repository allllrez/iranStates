<?php

namespace Alrez\IranStates\Traits;

trait ValidationRules
{
    public static function getStateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:states,slug',
        ];
    }

    public static function getCityRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cities,slug',
            'state_id' => 'required|exists:states,id',
        ];
    }
} 