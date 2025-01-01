# Laravel Provinces and Cities Management Package

This package provides an easy-to-use solution for managing provinces and cities in Laravel projects. It includes database migrations, seeders, models, and publishable controllers to allow seamless integration into your Laravel applications. You can also use custom commands for installation and setup.

---

## Features
- Manage provinces and cities with pre-filled data.
- Publishable models, controllers, and configuration files.
- Ready-to-use migrations and seeders.
- Custom commands for installation and setup.
- Unit-tested for reliability.

---

## Installation

1. Install the package via Composer:
   `composer require alrez/iranprovinces`

2. Publish the configuration file, controllers, and models:
   `php artisan vendor:publish --tag=iranprovinces`

3. Run the installation command to set up the database:
   `php artisan iranprovinces:install`

---

## Setup and Configuration

### Publishing Assets
After running the `vendor:publish` command, the following files will be available for customization:
- `config/iranprovinces.php`
- Controllers: `CityController`, `StateController`
- Models: `City`, `State`

### Database Setup
The `iranprovinces:install` command will:
- Publish migrations to your `database/migrations` folder.
- Seed the provinces and cities data from the JSON files.

### Customizing Configuration
The configuration file (`config/iranprovinces.php`) allows you to set:
- Default models for cities and states.
- Additional configurations for your application.

---

## Usage

### Models and Relationships
- `State` model has a `hasMany` relationship with `City`:
  ```php
  $state = State::find(1);
  $cities = $state->cities;
