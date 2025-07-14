<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Alrez\IranStates\Services\CityStateService;

class CityStateServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CityStateService();
    }

    /** @test */
    public function it_has_all_required_methods()
    {
        // بررسی که service دارای تمام متدهای لازم است
        $methods = get_class_methods(CityStateService::class);

        // متدهای اصلی
        $this->assertTrue(in_array('getAllStates', $methods));
        $this->assertTrue(in_array('getAllStatesWithCities', $methods));
        $this->assertTrue(in_array('getStateById', $methods));
        $this->assertTrue(in_array('getStateWithCitiesById', $methods));
        $this->assertTrue(in_array('getCitiesByStateId', $methods));
        $this->assertTrue(in_array('getCityById', $methods));

        // متدهای جستجو
        $this->assertTrue(in_array('searchCities', $methods));
        $this->assertTrue(in_array('searchStates', $methods));

        // متدهای batch
        $this->assertTrue(in_array('getStatesByIds', $methods));
        $this->assertTrue(in_array('getCitiesByStateIds', $methods));

        // متدهای آمار
        $this->assertTrue(in_array('getStatesCount', $methods));
        $this->assertTrue(in_array('getCitiesCount', $methods));

        // مدیریت cache
        $this->assertTrue(in_array('clearCache', $methods));
    }

    /** @test */
    public function it_has_correct_cache_constants()
    {
        // بررسی ثوابت cache
        $this->assertEquals(86400, CityStateService::CACHE_TTL);
        $this->assertEquals('iran_states.states', CityStateService::CACHE_KEY_STATES);
        $this->assertEquals('iran_states.cities.state_', CityStateService::CACHE_KEY_CITIES);
    }

    /** @test */
    public function it_can_instantiate_service()
    {
        // بررسی که service قابل instantiate است
        $this->assertInstanceOf(CityStateService::class, $this->service);
    }

    /** @test */
    public function service_methods_have_correct_return_types()
    {
        // بررسی نوع برگشتی متدها از طریق reflection
        $reflection = new \ReflectionClass(CityStateService::class);

        // متدهای Collection
        $getAllStates = $reflection->getMethod('getAllStates');
        $this->assertEquals('Illuminate\Database\Eloquent\Collection', $getAllStates->getReturnType()->getName());

        $getAllStatesWithCities = $reflection->getMethod('getAllStatesWithCities');
        $this->assertEquals('Illuminate\Database\Eloquent\Collection', $getAllStatesWithCities->getReturnType()->getName());

        // متدهای مدل واحد
        $getStateById = $reflection->getMethod('getStateById');
        $this->assertEquals('Alrez\IranStates\Models\State', $getStateById->getReturnType()->getName());

        $getCityById = $reflection->getMethod('getCityById');
        $this->assertEquals('Alrez\IranStates\Models\City', $getCityById->getReturnType()->getName());

        // متدهای آمار
        $getStatesCount = $reflection->getMethod('getStatesCount');
        $this->assertEquals('int', $getStatesCount->getReturnType()->getName());

        $getCitiesCount = $reflection->getMethod('getCitiesCount');
        $this->assertEquals('int', $getCitiesCount->getReturnType()->getName());
    }

    /** @test */
    public function service_methods_have_correct_parameter_types()
    {
        // بررسی نوع پارامترهای متدها
        $reflection = new \ReflectionClass(CityStateService::class);

        // متد getStateById
        $getStateById = $reflection->getMethod('getStateById');
        $parameters = $getStateById->getParameters();
        $this->assertEquals('int', $parameters[0]->getType()->getName());

        // متد searchCities
        $searchCities = $reflection->getMethod('searchCities');
        $parameters = $searchCities->getParameters();
        $this->assertEquals('string', $parameters[0]->getType()->getName());

        // متد getStatesByIds
        $getStatesByIds = $reflection->getMethod('getStatesByIds');
        $parameters = $getStatesByIds->getParameters();
        $this->assertEquals('array', $parameters[0]->getType()->getName());
    }
}