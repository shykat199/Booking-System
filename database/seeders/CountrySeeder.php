<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Australia',      'status' => ACTIVE_STATUS],
            ['name' => 'United States',  'status' => ACTIVE_STATUS],
            ['name' => 'United Kingdom', 'status' => ACTIVE_STATUS],
            ['name' => 'Canada',         'status' => ACTIVE_STATUS],
            ['name' => 'New Zealand',    'status' => ACTIVE_STATUS],
            ['name' => 'Germany',        'status' => ACTIVE_STATUS],
            ['name' => 'France',         'status' => ACTIVE_STATUS],
            ['name' => 'Japan',          'status' => ACTIVE_STATUS],
            ['name' => 'China',          'status' => ACTIVE_STATUS],
            ['name' => 'India',          'status' => ACTIVE_STATUS],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                [
                    'name' => $country['name']
                ], [
                    'status' => $country['status']
                ]
            );
        }
    }
}
