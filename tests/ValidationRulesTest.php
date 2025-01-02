<?php

use PHPUnit\Framework\TestCase;
use Alrez\IranStates\Traits\ValidationRules;

class ValidationRulesTest extends TestCase
{
    /**
     * Test getStateRules method.
     */
    public function testGetStateRules()
    {
        $rules = ValidationRules::getStateRules();

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('slug', $rules);
        $this->assertEquals('required|string|max:255', $rules['name']);
        $this->assertEquals('required|string|max:255|unique:states,slug', $rules['slug']);
    }

    /**
     * Test getCityRules method.
     */
    public function testGetCityRules()
    {
        $rules = ValidationRules::getCityRules();

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('slug', $rules);
        $this->assertArrayHasKey('state_id', $rules);
        $this->assertEquals('required|string|max:255', $rules['name']);
        $this->assertEquals('required|string|max:255|unique:cities,slug', $rules['slug']);
        $this->assertEquals('required|exists:states,id', $rules['state_id']);
    }
} 