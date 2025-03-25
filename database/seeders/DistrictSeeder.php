<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['state_id' => 1, 'name' => 'Pune'],
            ['state_id' => 1, 'name' => 'Mumbai'],
            ['state_id' => 2, 'name' => 'Ahmedabad'],
            ['state_id' => 3, 'name' => 'Bangalore'],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
