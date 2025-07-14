<?php

namespace Alrez\IranStates\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class StatesTableSeeder extends Seeder
{
    public function run()
    {
        $states = json_decode(file_get_contents(__DIR__ . '/../json/states.json'), true);

        // Prepare data for batch insertion
        $stateData = [];
        foreach ($states as $state) {
            $stateData[] = [
                'id' => $state['id'],
                'name' => $state['name'],
                'slug' => $state['slug'],
            ];
        }

        // Insert in chunks for consistency
        Collection::make($stateData)->chunk(1000)->each(function ($chunk) {
            DB::table('states')->insert($chunk->toArray());
        });
    }
}