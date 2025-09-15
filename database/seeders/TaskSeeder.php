<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [];
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            $tasks[] = [
                'title' => $faker->sentence(3),
                'is_completed' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Task::insert($tasks);
    }
}
