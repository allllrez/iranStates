# Iran Provinces | استان‌های ایران

<p align="center">
<img src="https://img.shields.io/badge/license-MIT-green" alt="License">
<img src="https://img.shields.io/badge/PHP-%3E%3D8.0-blue" alt="PHP Version">
<img src="https://img.shields.io/badge/Laravel-%5E10.0-red" alt="Laravel Version">
</p>

<div dir="rtl">

# پکیج استان‌های ایران برای لاراول

یک پکیج لاراول برای مدیریت استان‌ها و شهرهای ایران. این پکیج شامل لیست کامل استان‌ها و شهرهای ایران به همراه مدل‌ها و مایگریشن‌های آماده است.

## ویژگی‌ها
- لیست کامل استان‌ها و شهرهای ایران
- مدل‌های آماده با روابط از پیش تعریف شده
- مایگریشن و سیدر دیتابیس
- نصب و استفاده آسان
- تست شده به صورت کامل

## نصب

نصب از طریق کامپوزر:
```bash
composer require alrez/iran-provinces
```

## پیکربندی

1. انتشار فایل‌های پکیج:
```bash
php artisan vendor:publish --tag=iran-provinces
```

2. اجرای مایگریشن‌ها:
```bash
php artisan migrate
```

3. وارد کردن داده‌های اولیه:
```bash
php artisan db:seed --class=StatesTableSeeder
php artisan db:seed --class=CitiesTableSeeder
```

## نحوه استفاده

### دریافت همه استان‌ها
```php
use Alrez\IranProvinces\Models\State;

$states = State::all();
```

### دریافت شهرهای یک استان
```php
$state = State::find(1);
$cities = $state->cities;
```

### دریافت استان یک شهر
```php
use Alrez\IranProvinces\Models\City;

$city = City::find(1);
$state = $city->state;
```

### استفاده از کنترلرها
```php
// دریافت همه استان‌ها
Route::get('/states', [StateController::class, 'index']);

// دریافت شهرهای یک استان
Route::get('/cities/{state_id}', [CityController::class, 'getCitiesByState']);
```

## مدل‌ها

### استان (State)
```php
// فیلدهای موجود
id        // شناسه استان
name      // نام استان به فارسی
slug      // نام انگلیسی برای URL
```

### شهر (City)
```php
// فیلدهای موجود
id        // شناسه شهر
state_id  // شناسه استان مربوطه
name      // نام شهر به فارسی
slug      // نام انگلیسی برای URL
```

## ساختار دیتابیس

### جدول استان‌ها (states)
- `id` - bigint(20)
- `name` - varchar(255)
- `slug` - varchar(255)

### جدول شهرها (cities)
- `id` - bigint(20)
- `state_id` - bigint(20) foreign key
- `name` - varchar(255)
- `slug` - varchar(255)

## مشارکت

از مشارکت شما در توسعه این پکیج استقبال می‌کنیم! می‌توانید مشارکت خود را از طریق Pull Request ارسال کنید.

## لایسنس

این پکیج تحت لایسنس MIT منتشر شده است. برای اطلاعات بیشتر [فایل لایسنس](LICENSE.md) را مطالعه کنید.

## پشتیبانی

اگر مشکل امنیتی پیدا کردید، لطفاً به جای استفاده از issue tracker، به ایمیل anabestanireza@yahoo.com اطلاع دهید.

</div>

---

# English Documentation

A Laravel package for managing Iran's provinces (states) and cities. This package provides a complete list of Iran's provinces and their cities, with easy-to-use models and migrations.

## Features
- Complete list of Iran's provinces and cities
- Ready-to-use models with relationships
- Database migrations and seeders
- Easy to install and use
- Fully tested

## Installation

You can install the package via composer:
```bash
composer require alrez/iran-provinces
```

## Configuration

1. Publish the package assets:
```bash
php artisan vendor:publish --tag=iran-provinces
```

2. Run the migrations:
```bash
php artisan migrate
```

3. Seed the database:
```bash
php artisan db:seed --class=StatesTableSeeder
php artisan db:seed --class=CitiesTableSeeder
```

## Usage

### Get all provinces
```php
use Alrez\IranProvinces\Models\State;

$states = State::all();
```

### Get cities of a province
```php
$state = State::find(1);
$cities = $state->cities;
```

### Get province of a city
```php
use Alrez\IranProvinces\Models\City;

$city = City::find(1);
$state = $city->state;
```

### Using the controllers
```php
// Get all states
Route::get('/states', [StateController::class, 'index']);

// Get cities of a state
Route::get('/cities/{state_id}', [CityController::class, 'getCitiesByState']);
```

## Models

### State
```php
// Available fields
id    // Province ID
name  // Province name in Persian
slug  // URL-friendly version of name
```

### City
```php
// Available fields
id        // City ID
state_id  // Related province ID
name      // City name in Persian
slug      // URL-friendly version of name
```

## Database Structure

### states table
- `id` - bigint(20)
- `name` - varchar(255)
- `slug` - varchar(255)

### cities table
- `id` - bigint(20)
- `state_id` - bigint(20) foreign key
- `name` - varchar(255)
- `slug` - varchar(255)

## Contributing

Thank you for considering contributing to Iran Provinces! You can submit your contributions through Pull Requests.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

If you discover any security-related issues, please email anabestanireza@yahoo.com instead of using the issue tracker.