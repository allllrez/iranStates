<?php

namespace Alrez\IranStates\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'iran-states:install';
    protected $description = 'Install the Iran States package';

    public function handle()
    {
        $this->info('Publishing configurations...');
        Artisan::call('vendor:publish', ['--tag' => 'iran-states']);

        $this->info('Publishing migrations...');
        Artisan::call('vendor:publish', ['--tag' => 'migrations']);

        $this->info('Publishing seeders...');
        Artisan::call('vendor:publish', ['--tag' => 'seeders']);

        $this->info('Running migrations...');
        Artisan::call('migrate');

        $this->info('Seeding database...');
        Artisan::call('db:seed', ['--class' => 'StatesTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'CitiesTableSeeder']);

        $this->info('Iran States package installed successfully.');
    }
}