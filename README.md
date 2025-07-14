# پکیج استان‌ها و شهرهای ایران برای لاراول

<div dir="rtl">

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.2-8892BF.svg)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/laravel-11%20%7C%2012-FF2D20.svg)](https://laravel.com)

## درباره پکیج
این پکیج برای مدیریت استان‌ها و شهرهای ایران در فریم‌ورک لاراول طراحی شده است. با استفاده از این پکیج می‌توانید به راحتی به لیست استان‌ها و شهرهای ایران دسترسی داشته باشید.

## ویژگی‌های جدید
- سازگار با Laravel 11 و 12
- Seeder بهینه شده با استفاده از chunk(1000)
- دو trait جدید برای مدیریت روابط
- Service بهینه شده با cache بهتر
- Type hints کامل برای PHP 8.2+

## نصب

برای نصب از طریق کامپوزر:

```bash
composer require alrez/iran-states
```

سپس برای نصب جداول و داده‌های پایه:

```bash
php artisan iranStates:install
```

این دستور به صورت خودکار مایگریشن‌ها را اجرا کرده و داده‌های پایه را در دیتابیس وارد می‌کند.

## انتشار فایل‌های پکیج (اختیاری)

برای انتشار فایل کانفیگ:
```bash
php artisan vendor:publish --tag=iran-states
```

## استفاده

### مدل‌ها با Traits جدید

#### مدل City با InteractWithState

```php
use Alrez\IranStates\Models\City;

$city = City::find(1);

// استفاده از trait methods
$state = $city->getStateById($city->state_id);
$citiesInSameState = $city->getCitiesByState($city->state_id);
$belongsToTehran = $city->belongsToState(8); // تهران
```

#### مدل State با InteractWithStates

```php
use Alrez\IranStates\Models\State;

$state = State::find(1);

// استفاده از trait methods
$allStates = $state->getAllStates();
$statesWithCities = $state->getAllStatesWithCities();
$searchResult = $state->searchStates('تهران');
$specificStates = $state->getStatesByIds([1, 2, 3]);
$citiesFromStates = $state->getCitiesFromStates([1, 2, 3]);
$statesCount = $state->getStatesCount();
```

### استفاده از Traits در مدل‌های شخصی

#### برای مدل‌هایی که به یک استان تعلق دارند

```php
use Alrez\IranStates\Traits\InteractWithState;

class User extends Model
{
    use InteractWithState;
    
    // حالا می‌توانید از متدهای trait استفاده کنید
}

$user = new User();
$userState = $user->getStateById($user->state_id);
$citiesInUserState = $user->getCitiesByState($user->state_id);
```

#### برای مدل‌هایی که با چندین استان کار می‌کنند

```php
use Alrez\IranStates\Traits\InteractWithStates;

class Organization extends Model
{
    use InteractWithStates;
    
    // حالا می‌توانید از متدهای trait استفاده کنید
}

$org = new Organization();
$allStates = $org->getAllStates();
$statesWithCities = $org->getAllStatesWithCities();
$searchedStates = $org->searchStates('خراسان');
```

### سرویس بهینه شده

```php
use Alrez\IranStates\Services\CityStateService;

$service = new CityStateService();

// دریافت همه استان‌ها (از cache)
$allStates = $service->getAllStates();

// دریافت استان‌ها با شهرها (برای dropdown ها)
$statesWithCities = $service->getAllStatesWithCities();

// دریافت یک استان خاص
$state = $service->getStateById(8);

// دریافت یک استان با شهرهایش
$stateWithCities = $service->getStateWithCitiesById(8);

// دریافت شهرهای یک استان
$cities = $service->getCitiesByStateId(8);

// دریافت یک شهر خاص
$city = $service->getCityById(1);

// جستجو در شهرها
$searchedCities = $service->searchCities('تهران');

// جستجو در استان‌ها
$searchedStates = $service->searchStates('خراسان');

// عملیات batch برای چندین استان
$multipleStates = $service->getStatesByIds([1, 2, 3]);
$citiesFromMultipleStates = $service->getCitiesByStateIds([1, 2, 3]);

// آمار
$statesCount = $service->getStatesCount();
$citiesCount = $service->getCitiesCount();

// پاک کردن cache
$service->clearCache();
```

### قوانین اعتبارسنجی

```php
use Alrez\IranStates\Traits\ValidationRules;

class YourController
{
    use ValidationRules;
    
    public function validateState($request)
    {
        $rules = $this->getStateRules();
        // اعتبارسنجی...
    }
    
    public function validateCity($request) 
    {
        $rules = $this->getCityRules();
        // اعتبارسنجی...
    }
}
```

## نکات عملکرد

### Cache
- تمام عملیات اصلی cache شده‌اند (24 ساعت)
- برای پاک کردن cache از `clearCache()` استفاده کنید
- عملیات جستجو cache نمی‌شوند

### انتخاب متد مناسب
- برای dropdown کامل: `getAllStatesWithCities()`
- برای یک استان خاص: `getStateById()`
- برای شهرهای یک استان: `getCitiesByStateId()`
- برای عملیات چندتایی: `getStatesByIds()` یا `getCitiesByStateIds()`

</div>

---

# Iran States Package for Laravel

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.2-8892BF.svg)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/laravel-11%20%7C%2012-FF2D20.svg)](https://laravel.com)

## About
This package provides a comprehensive solution for managing Iran's states and cities in Laravel applications. It offers easy access to a complete list of Iran's states and their corresponding cities with improved performance and modern Laravel features.

## New Features
- Compatible with Laravel 11 & 12
- Optimized seeders using chunk(1000)
- Two new traits for relationship management
- Enhanced service with better caching
- Full type hints for PHP 8.2+

## Installation

Install via Composer:

```bash
composer require alrez/iran-states
```

Then install the tables and seed the data:

```bash
php artisan iranStates:install
```

This command will automatically run the migrations and seed the database with the initial data using optimized chunked insertion.

## Publishing Package Files (Optional)

To publish the config file:
```bash
php artisan vendor:publish --tag=iran-states
```

## Usage

### Models with New Traits

#### City Model with InteractWithState

```php
use Alrez\IranStates\Models\City;

$city = City::find(1);

// Using trait methods
$state = $city->getStateById($city->state_id);
$citiesInSameState = $city->getCitiesByState($city->state_id);
$belongsToTehran = $city->belongsToState(8); // Tehran
```

#### State Model with InteractWithStates

```php
use Alrez\IranStates\Models\State;

$state = State::find(1);

// Using trait methods
$allStates = $state->getAllStates();
$statesWithCities = $state->getAllStatesWithCities();
$searchResult = $state->searchStates('Tehran');
$specificStates = $state->getStatesByIds([1, 2, 3]);
$citiesFromStates = $state->getCitiesFromStates([1, 2, 3]);
$statesCount = $state->getStatesCount();
```

### Using Traits in Your Own Models

#### For models that belong to a single state

```php
use Alrez\IranStates\Traits\InteractWithState;

class User extends Model
{
    use InteractWithState;
    
    // Now you can use trait methods
}

$user = new User();
$userState = $user->getStateById($user->state_id);
$citiesInUserState = $user->getCitiesByState($user->state_id);
```

#### For models that work with multiple states

```php
use Alrez\IranStates\Traits\InteractWithStates;

class Organization extends Model
{
    use InteractWithStates;
    
    // Now you can use trait methods
}

$org = new Organization();
$allStates = $org->getAllStates();
$statesWithCities = $org->getAllStatesWithCities();
$searchedStates = $org->searchStates('Khorasan');
```

### Enhanced Service

```php
use Alrez\IranStates\Services\CityStateService;

$service = new CityStateService();

// Get all states (cached)
$allStates = $service->getAllStates();

// Get states with cities (for dropdowns)
$statesWithCities = $service->getAllStatesWithCities();

// Get specific state
$state = $service->getStateById(8);

// Get state with its cities
$stateWithCities = $service->getStateWithCitiesById(8);

// Get cities of a state
$cities = $service->getCitiesByStateId(8);

// Get specific city
$city = $service->getCityById(1);

// Search cities
$searchedCities = $service->searchCities('Tehran');

// Search states
$searchedStates = $service->searchStates('Khorasan');

// Batch operations for multiple states
$multipleStates = $service->getStatesByIds([1, 2, 3]);
$citiesFromMultipleStates = $service->getCitiesByStateIds([1, 2, 3]);

// Statistics
$statesCount = $service->getStatesCount();
$citiesCount = $service->getCitiesCount();

// Clear cache
$service->clearCache();
```

### Validation Rules

```php
use Alrez\IranStates\Traits\ValidationRules;

class YourController
{
    use ValidationRules;
    
    public function validateState($request)
    {
        $rules = $this->getStateRules();
        // Validation...
    }
    
    public function validateCity($request) 
    {
        $rules = $this->getCityRules();
        // Validation...
    }
}
```

## Performance Notes

### Caching
- All main operations are cached (24 hours)
- Use `clearCache()` to clear cache when needed
- Search operations are not cached

### Choosing the Right Method
- For complete dropdown: `getAllStatesWithCities()`
- For specific state: `getStateById()`
- For cities of a state: `getCitiesByStateId()`
- For batch operations: `getStatesByIds()` or `getCitiesByStateIds()`

## Requirements

- PHP 8.2 or higher
- Laravel 11.x or 12.x

## License

MIT License. Please see [License File](LICENSE) for more information.