<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Programs;
use App\Models\StudyArea;
use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $universities = [
            // Australia
            ['name' => 'Deakin University',          'country' => 'Australia', 'city' => 'Melbourne',  'cricos' => '00113B'],
            ['name' => 'The University of Sydney',   'country' => 'Australia', 'city' => 'Sydney',     'cricos' => '00026A'],

            // United States
            ['name' => 'Harvard University',         'country' => 'United States', 'city' => 'Boston'],
            ['name' => 'Stanford University',        'country' => 'United States', 'city' => 'Los Angeles'],

            // United Kingdom
            ['name' => 'University of Oxford',       'country' => 'United Kingdom', 'city' => 'London'],
            ['name' => 'University of Manchester',   'country' => 'United Kingdom', 'city' => 'Manchester'],

            // Canada
            ['name' => 'University of Toronto',      'country' => 'Canada', 'city' => 'Toronto'],
            ['name' => 'University of British Columbia', 'country' => 'Canada', 'city' => 'Vancouver'],

            // New Zealand
            ['name' => 'University of Auckland',     'country' => 'New Zealand', 'city' => 'Auckland'],
            ['name' => 'Victoria University of Wellington', 'country' => 'New Zealand', 'city' => 'Wellington'],

            // Germany
            ['name' => 'Humboldt University of Berlin', 'country' => 'Germany', 'city' => 'Berlin'],
            ['name' => 'Ludwig Maximilian University of Munich', 'country' => 'Germany', 'city' => 'Munich'],

            // France
            ['name' => 'Sorbonne University',        'country' => 'France', 'city' => 'Paris'],
            ['name' => 'Université de Lyon',         'country' => 'France', 'city' => 'Lyon'],

            // Japan
            ['name' => 'University of Tokyo',        'country' => 'Japan', 'city' => 'Tokyo'],
            ['name' => 'Kyoto University',           'country' => 'Japan', 'city' => 'Kyoto'],

            // China
            ['name' => 'Peking University',          'country' => 'China', 'city' => 'Beijing'],
            ['name' => 'Fudan University',           'country' => 'China', 'city' => 'Shanghai'],

            // India
            ['name' => 'University of Delhi',        'country' => 'India', 'city' => 'Delhi'],
            ['name' => 'Indian Institute of Science', 'country' => 'India', 'city' => 'Bangalore'],
        ];

        foreach ($universities as $uni) {
            $country = Country::where('name', $uni['country'])->first();
            $city = City::where('name', $uni['city'])->first();

            if ($country && $city) {
                $university = University::updateOrCreate(
                    ['name' => $uni['name']],
                    [
                        'country_id' => $country->id,
                        'city_id' => $city->id,
                        'cricos' => $uni['cricos'] ?? null,
                        'campus_count' => rand(1, 6),
                        'description' => $uni['name'].' is one of the leading universities in '.$uni['country'].'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'logo' => strtolower(str_replace(' ', '-', $uni['name'])).'-logo.png',
                        'image' => strtolower(str_replace(' ', '-', $uni['name'])).'-campus.jpg',
                        'status' => ACTIVE_STATUS,
                    ]
                );

                $programs = Programs::inRandomOrder()->take(random_int(2, 4))->get();

                foreach ($programs as $program) {
                    StudyArea::updateOrCreate(
                        [
                            'university_id' => $university->id,
                            'program_id' => $program->id,
                        ],
                        [
                            'name' => $program->name . ' at ' . $university->name,
                        ]
                    );
                }
            }
        }
    }
}
