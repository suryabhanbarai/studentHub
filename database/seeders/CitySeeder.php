<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['district_id' => 1, 'name' => 'Pimpri'],
            ['district_id' => 1, 'name' => 'Shivaji Nagar'],
            ['district_id' => 2, 'name' => 'Thane'],
            ['district_id' => 3, 'name' => 'Vadodara'],
            ['district_id' => 4, 'name' => 'Mysore'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
