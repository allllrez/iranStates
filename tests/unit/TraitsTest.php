<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Alrez\IranStates\Traits\InteractWithState;
use Alrez\IranStates\Traits\InteractWithStates;
use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;

class TraitsTest extends TestCase
{
    /** @test */
    public function it_has_interact_with_state_trait_methods()
    {
        // بررسی که trait دارای متدهای لازم است
        $methods = get_class_methods(InteractWithState::class);

        $this->assertTrue(in_array('getStateById', $methods));
        $this->assertTrue(in_array('getCitiesByState', $methods));
        $this->assertTrue(in_array('belongsToState', $methods));
    }

    /** @test */
    public function it_has_interact_with_states_trait_methods()
    {
        // بررسی که trait دارای متدهای لازم است
        $methods = get_class_methods(InteractWithStates::class);

        $this->assertTrue(in_array('getAllStates', $methods));
        $this->assertTrue(in_array('getAllStatesWithCities', $methods));
        $this->assertTrue(in_array('searchStates', $methods));
        $this->assertTrue(in_array('getStatesByIds', $methods));
        $this->assertTrue(in_array('getCitiesFromStates', $methods));
        $this->assertTrue(in_array('getStatesCount', $methods));
    }

    /** @test */
    public function it_can_use_interact_with_state_trait_in_models()
    {
        // بررسی که مدل City از trait استفاده می‌کند
        $city = new City();
        $traits = class_uses($city);

        $this->assertTrue(in_array(InteractWithState::class, $traits));
    }

    /** @test */
    public function it_can_use_interact_with_states_trait_in_models()
    {
        // بررسی که مدل State از trait استفاده می‌کند
        $state = new State();
        $traits = class_uses($state);

        $this->assertTrue(in_array(InteractWithStates::class, $traits));
    }

    /** @test */
    public function it_can_check_belongs_to_state_method_signature()
    {
        $city = new City(['state_id' => 8]);

        // بررسی که متد belongsToState صحیح کار می‌کند
        $this->assertTrue($city->belongsToState(8));
        $this->assertFalse($city->belongsToState(5));
    }
}
