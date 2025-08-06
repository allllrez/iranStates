# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.3.2] - 2025-01-25

### Fixed
- 🐛 **Autoload Issue**: Fixed seeder loading issue on Linux servers by using `require_once` instead of dependency injection
- 🐛 **InstallCommand**: Resolved "Target class does not exist" error when running `php artisan iranStates:install`

## [2.3.0] - 2025-01-25

### Added
- ✨ **New Traits**: Added `InteractWithState` and `InteractWithStates` traits for better relationship management
- ✨ **Laravel 12 Support**: Full compatibility with Laravel 12.x
- ✨ **Enhanced Service Methods**: Added new methods to `CityStateService`:
  - `getStateWithCitiesById()` - Get state with its cities
  - `getStatesByIds()` - Batch operation for multiple states
  - `getCitiesByStateIds()` - Get cities from multiple states
  - `getStatesCount()` and `getCitiesCount()` - Statistics methods
- ✨ **Type Hints**: Full PHP 8.2+ type hints for all methods
- ✨ **Comprehensive Tests**: Added complete test coverage for new features

### Changed
- 🔧 **PHP Requirement**: Updated minimum PHP version to 8.2+
- 🔧 **Optimized Seeders**: Seeders now use `chunk(1000)` for better performance
- 🔧 **Enhanced Caching**: Improved cache management in service methods
- 🔧 **Better Documentation**: Updated README with new features and usage examples

### Removed
- 🗑️ **Deprecated Trait**: Removed old `HasCitiesAndStates` trait (replaced by new specific traits)

### Fixed
- 🐛 **Cache Keys**: Fixed cache key conflicts and improved cache clearing
- 🐛 **Test Coverage**: Updated and fixed all PHPUnit tests

## [2.2.x] - Previous Versions
- Previous stable release with Laravel 10/11 support

---

## Migration Guide to 2.3.0

### If you were using the old `HasCitiesAndStates` trait:

**Before (v2.2.x):**
```php
use Alrez\IranStates\Traits\HasCitiesAndStates;

class YourModel extends Model 
{
    use HasCitiesAndStates;
}
```

**After (v2.3.0):**
```php
use Alrez\IranStates\Traits\InteractWithState;     // For single state
use Alrez\IranStates\Traits\InteractWithStates;    // For multiple states

class YourModel extends Model 
{
    use InteractWithState;    // or InteractWithStates
}
```

### New Service Methods Available:
```php
$service = new CityStateService();

// New methods in v2.3.0
$stateWithCities = $service->getStateWithCitiesById(1);
$multipleStates = $service->getStatesByIds([1, 2, 3]);
$citiesFromStates = $service->getCitiesByStateIds([1, 2, 3]);
$statesCount = $service->getStatesCount();
$citiesCount = $service->getCitiesCount();
``` 