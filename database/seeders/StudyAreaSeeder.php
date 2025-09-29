<?php

namespace Database\Seeders;

use App\Models\Programs;
use App\Models\StudyArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programStudyAreas = [
            'Bachelor of Arts'           => ['History', 'Philosophy', 'Literature'],
            'Bachelor of Science'        => ['Physics', 'Chemistry', 'Biology'],
            'Bachelor of Engineering'    => ['Civil Engineering', 'Mechanical Engineering', 'Electrical Engineering'],
            'Bachelor of Business'       => ['Finance', 'Marketing', 'Accounting'],
            'Bachelor of IT'             => ['Software Development', 'Cybersecurity', 'Data Science'],

            'Master of Arts'             => ['Cultural Studies', 'Linguistics', 'International Relations'],
            'Master of Science'          => ['Applied Physics', 'Biotechnology', 'Mathematics'],
            'Master of Engineering'      => ['Structural Engineering', 'Robotics', 'Energy Systems'],
            'Master of Business Admin'   => ['Project Management', 'Finance', 'Business Analytics'],
            'Master of IT'               => ['Cloud Computing', 'AI & ML', 'Network Security'],
        ];

        foreach ($programStudyAreas as $programName => $areas) {
            $program = Programs::where('name', $programName)->first();

            if ($program) {
                foreach ($areas as $areaName) {
                    StudyArea::updateOrCreate(
                        ['program_id' => $program->id, 'name' => $areaName],
                        ['status' => ACTIVE_STATUS]
                    );
                }
            }
        }
    }
}
