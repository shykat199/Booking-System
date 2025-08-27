<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceBooking;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ServiceBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        $users = User::where('role', USER_ROLE)->pluck('id')->toArray();
        $services = Service::pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            ServiceBooking::create([
                'user_id' => $faker->randomElement($users),
                'service_id' => $faker->randomElement($services),
                'booking_date' => $faker->dateTimeBetween('-1 month', '+1 month'),
                'status' => $faker->randomElement([PENDING_STATUS, ACTIVE_STATUS]),
            ]);
        }

    }
}
