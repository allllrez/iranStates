# Iran Provinces for Laravel

<p align="center">
<a href="https://github.com/alrez/iran-provinces/blob/master/LICENSE"><img src="https://img.shields.io/github/license/alrez/iran-provinces" alt="License"></a>
<img src="https://img.shields.io/badge/PHP-%3E%3D8.0-blue" alt="PHP Version">
<img src="https://img.shields.io/badge/Laravel-%5E10.0-red" alt="Laravel Version">
</p>

A Laravel package for managing Iran's provinces (states) and cities. This package provides a complete list of Iran's provinces and their cities, with easy-to-use models and migrations.

یک پکیج لاراول برای مدیریت استان‌ها و شهرهای ایران. این پکیج شامل لیست کامل استان‌ها و شهرهای ایران به همراه مدل‌ها و مایگریشن‌های آماده است.

## Features | ویژگی‌ها

- Complete list of Iran's provinces and cities | لیست کامل استان‌ها و شهرهای ایران
- Ready-to-use models with relationships | مدل‌های آماده با روابط از پیش تعریف شده
- Database migrations and seeders | مایگریشن و سیدر دیتابیس
- Easy to install and use | نصب و استفاده آسان
- Fully tested | تست شده به صورت کامل

## Installation | نصب

You can install the package via composer | نصب از طریق کامپوزر:

```bash
composer require alrez/iran-provinces
```

## Configuration | پیکربندی

1. Publish the package assets | انتشار فایل‌های پکیج:
```bash
php artisan vendor:publish --tag=iran-provinces
```

2. Run the migrations | اجرای مایگریشن‌ها:
```bash
php artisan migrate
```

3. Seed the database | وارد کردن داده‌های اولیه:
```bash
php artisan db:seed --class=StatesTableSeeder
php artisan db:seed --class=CitiesTableSeeder
```

## Usage | نحوه استفاده

### Get all provinces | دریافت همه استان‌ها
```php
use Alrez\IranProvinces\Models\State;

$states = State::all();
```

### Get cities of a province | دریافت شهرهای یک استان
```php
$state = State::find(1);
$cities = $state->cities;
```

### Get province of a city | دریافت استان یک شهر
```php
use Alrez\IranProvinces\Models\City;

$city = City::find(1);
$state = $city->state;
```

### Using the controllers | استفاده از کنترلرها
The package includes two controllers that you can use or extend:

```php
// Get all states
Route::get('/states', [StateController::class, 'index']);

// Get cities of a state
Route::get('/cities/{state_id}', [CityController::class, 'getCitiesByState']);
```

## Models | مدل‌ها

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

## Database Structure | ساختار دیتابیس

### states table
- `id` - bigint(20)
- `name` - varchar(255)
- `slug` - varchar(255)

### cities table
- `id` - bigint(20)
- `state_id` - bigint(20) foreign key
- `name` - varchar(255)
- `slug` - varchar(255)

## Contributing | مشارکت

Thank you for considering contributing to Iran Provinces! You can submit your contributions through Pull Requests.

از مشارکت شما در توسعه این پکیج استقبال می‌کنیم! می‌توانید مشارکت خود را از طریق Pull Request ارسال کنید.

## License | لایسنس

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support | پشتیبانی

If you discover any security-related issues, please email anabestanireza@yahoo.com instead of using the issue tracker.

اگر مشکل امنیتی پیدا کردید، لطفاً به جای استفاده از issue tracker، به ایمیل anabestanireza@yahoo.com اطلاع دهید.