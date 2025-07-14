<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Alrez\IranStates\Traits\ValidationRules;

class ValidationRulesTest extends TestCase
{
    /** @test */
    public function it_can_get_state_validation_rules()
    {
        $rules = ValidationRules::getStateRules();

        $this->assertIsArray($rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('slug', $rules);
        $this->assertEquals('required|string|max:255', $rules['name']);
        $this->assertEquals('required|string|max:255|unique:states,slug', $rules['slug']);
    }

    /** @test */
    public function it_can_get_city_validation_rules()
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

    /** @test */
    public function validation_rules_trait_has_correct_methods()
    {
        // بررسی که trait دارای متدهای لازم است
        $methods = get_class_methods(ValidationRules::class);

        $this->assertTrue(in_array('getStateRules', $methods));
        $this->assertTrue(in_array('getCityRules', $methods));
    }

    /** @test */
    public function validation_rules_returns_array_types()
    {
        // بررسی نوع برگشتی متدها
        $stateRules = ValidationRules::getStateRules();
        $cityRules = ValidationRules::getCityRules();

        $this->assertIsArray($stateRules);
        $this->assertIsArray($cityRules);
        $this->assertNotEmpty($stateRules);
        $this->assertNotEmpty($cityRules);
    }
}
