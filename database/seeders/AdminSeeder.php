<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            'name' => 'Admin User',
            'role' =>  ADMIN_ROLE,
            'email' => 'admin@gmail.com',
            'phone' => '01700000000',
            'password' => Hash::make('12345678'),
            'status' => ACTIVE_STATUS
        ];

        User::firstOrCreate(
            ['email' => $data['email']],
            $data
        );
    }
}
