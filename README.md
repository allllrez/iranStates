# پکیج استان‌ها و شهرهای ایران برای لاراول

<div dir="rtl">

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.0-8892BF.svg)](https://www.php.net/)

## درباره پکیج
این پکیج برای مدیریت استان‌ها و شهرهای ایران در فریم‌ورک لاراول طراحی شده است. با استفاده از این پکیج می‌توانید به راحتی به لیست استان‌ها و شهرهای ایران دسترسی داشته باشید.

## نصب

برای نصب از طریق کامپوزر:

```bash
composer require alrez/iran-states
```

لاراول به صورت خودکار پکیج را شناسایی و نصب می‌کند. نیازی به ثبت دستی سرویس پروایدر نیست.

## انتشار فایل‌های پکیج

برای انتشار همه فایل‌ها:
```bash
php artisan vendor:publish --provider="Alrez\IranStates\IranStatesServiceProvider"
```

یا انتشار به صورت جداگانه:

برای فایل‌های اصلی (کانفیگ، کنترلرها و JSON):
```bash
php artisan vendor:publish --tag=iran-states
```

برای مایگریشن‌ها:
```bash
php artisan vendor:publish --tag=migrations
```

برای سیدرها:
```bash
php artisan vendor:publish --tag=seeders
```

## استفاده

### مدل‌ها
```php
use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;

// دریافت همه استان‌ها
$states = State::all();

// دریافت شهرهای یک استان
$state = State::find(1);
$cities = $state->cities;

// دریافت استان یک شهر
$city = City::find(1);
$state = $city->state;
```

### سرویس
```php
use Alrez\IranStates\Services\CityStateService;

$service = new CityStateService();
$statesWithCities = $service->getAllStatesWithCities();
```

### تریت
```php
use Alrez\IranStates\Traits\HasCitiesAndStates;

class YourModel
{
    use HasCitiesAndStates;
}

// استفاده
$model = new YourModel();
$states = $model->getStates();
$cities = $model->getCitiesByState($stateId);
```

</div>

---

# Iran States Package for Laravel

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.0-8892BF.svg)](https://www.php.net/)

## About
This package provides a comprehensive solution for managing Iran's states and cities in Laravel applications. It offers easy access to a complete list of Iran's states and their corresponding cities.

## Installation

Install via Composer:

```bash
composer require alrez/iran-states
```

Laravel will automatically discover and register the package. No manual service provider registration is needed.

## Publishing Package Files

To publish all files:
```bash
php artisan vendor:publish --provider="Alrez\IranStates\IranStatesServiceProvider"
```

Or publish separately:

For main files (config, controllers, and JSON):
```bash
php artisan vendor:publish --tag=iran-states
```

For migrations:
```bash
php artisan vendor:publish --tag=migrations
```

For seeders:
```bash
php artisan vendor:publish --tag=seeders
```

## Usage

### Models
```php
use Alrez\IranStates\Models\State;
use Alrez\IranStates\Models\City;

// Get all states
$states = State::all();

// Get cities of a state
$state = State::find(1);
$cities = $state->cities;

// Get state of a city
$city = City::find(1);
$state = $city->state;
```

### Service
```php
use Alrez\IranStates\Services\CityStateService;

$service = new CityStateService();
$statesWithCities = $service->getAllStatesWithCities();
```

### Trait
```php
use Alrez\IranStates\Traits\HasCitiesAndStates;

class YourModel
{
    use HasCitiesAndStates;
}

// Usage
$model = new YourModel();
$states = $model->getStates();
$cities = $model->getCitiesByState($stateId);
```