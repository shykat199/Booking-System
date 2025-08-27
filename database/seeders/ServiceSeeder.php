<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'name' => ucfirst($faker->words(3, true)),
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 50, 500),
                'status' => ACTIVE_STATUS
            ];

            Service::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
