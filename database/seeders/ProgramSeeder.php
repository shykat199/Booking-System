<?php

namespace Database\Seeders;

use App\Models\Programs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            ['name' => 'Bachelor of Arts',         'duration' => 3, 'status' => ACTIVE_STATUS],
            ['name' => 'Bachelor of Science',      'duration' => 3, 'status' => ACTIVE_STATUS],
            ['name' => 'Bachelor of Engineering',  'duration' => 4, 'status' => ACTIVE_STATUS],
            ['name' => 'Bachelor of Business',     'duration' => 3, 'status' => ACTIVE_STATUS],
            ['name' => 'Bachelor of IT',           'duration' => 3, 'status' => ACTIVE_STATUS],

            ['name' => 'Master of Arts',           'duration' => 2, 'status' => ACTIVE_STATUS],
            ['name' => 'Master of Science',        'duration' => 2, 'status' => ACTIVE_STATUS],
            ['name' => 'Master of Engineering',    'duration' => 2, 'status' => ACTIVE_STATUS],
            ['name' => 'Master of Business Admin', 'duration' => 2, 'status' => ACTIVE_STATUS],
            ['name' => 'Master of IT',             'duration' => 2, 'status' => ACTIVE_STATUS],
        ];

        foreach ($programs as $program) {
            Programs::updateOrCreate(
                ['name' => $program['name']],
                ['duration' => $program['duration'], 'status' => $program['status']]
            );
        }
    }
}
