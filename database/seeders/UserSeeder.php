<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 30; $i++) {

            $data = [
                'name' => $faker->name,
                'role' => USER_ROLE,
                'email' => $faker->unique()->safeEmail,
                'phone' => substr($faker->phoneNumber, 0, 15),
                'password' => Hash::make('12345678'),
                'status' => ACTIVE_STATUS
            ];


            User::firstOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}
