<?php

namespace Alrez\IranStates\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    public function run()
    {
        $states = json_decode(file_get_contents(__DIR__ . '/../json/states.json'), true);

        foreach ($states as $state) {
            DB::table('states')->insert([
                'id' => $state['id'],
                'name' => $state['name'],
                'slug' => $state['slug'],
            ]);
        }
    }
} 