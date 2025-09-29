<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            ServiceBookingSeeder::class,
            TaskSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            ProgramSeeder::class,
            StudyAreaSeeder::class,
            UniversitySeeder::class,
        ]);
    }
}
