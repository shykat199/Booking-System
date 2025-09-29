<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countriesWithCities = [
            'Australia'      => ['Melbourne', 'Sydney', 'Brisbane'],
            'United States'  => ['New York', 'Los Angeles', 'Boston'],
            'United Kingdom' => ['London', 'Manchester', 'Birmingham'],
            'Canada'         => ['Toronto', 'Vancouver', 'Montreal'],
            'New Zealand'    => ['Auckland', 'Wellington', 'Christchurch'],
            'Germany'        => ['Berlin', 'Munich', 'Hamburg'],
            'France'         => ['Paris', 'Lyon', 'Marseille'],
            'Japan'          => ['Tokyo', 'Osaka', 'Kyoto'],
            'China'          => ['Beijing', 'Shanghai', 'Guangzhou'],
            'India'          => ['Delhi', 'Mumbai', 'Bangalore'],
        ];
        foreach ($countriesWithCities as $countryName => $cities) {
            $country = Country::where('name', $countryName)->first();

            if ($country) {
                foreach ($cities as $cityName) {
                    City::updateOrCreate(
                        ['name' => $cityName, 'country_id' => $country->id],
                        ['status' => 1]
                    );
                }
            }
        }

    }
}
