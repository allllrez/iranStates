   ```md
   # Laravel City-State Package
   ## Installation
   ```bash
   composer require yourname/laravel-city-state
   php artisan migrate
   php artisan db:seed --class=CityStateSeeder
   ```
   ## Usage
   Publish configuration:
   ```bash
   php artisan vendor:publish --tag=city-state-config
   ```
   ## API Endpoints
   - `/cities` - Get all cities
   - `/states` - Get all states
   ```