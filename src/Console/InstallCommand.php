<?php

namespace Alrez\IranStates\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
class InstallCommand extends Command
{
    protected $signature = 'iran-provinces:install';
    protected $description = 'Install the Iran Provinces package';

    public function handle()
    {
        $this->info('Publishing configurations...');
        Artisan::call('vendor:publish --tag=config --force');

        $this->info('Publishing migrations...');
        Artisan::call('vendor:publish --tag=migrations --force');

        $this->info('Publishing seeders...');
        Artisan::call('db:seed', ['--class' => 'StateSeeder']);
        Artisan::call('db:seed', ['--class' => 'CitySeeder']);

        $this->info('Running migrations...');
        Artisan::call('migrate');

        $this->info('Seeding database...');
        Artisan::call('db:seed --class=CityStateSeeder');

        $this->info('Iran Provinces package installed successfully.');
    }
}