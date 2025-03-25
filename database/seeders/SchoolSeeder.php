<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\School;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            [
                'name' => 'Springdale School',
                'address' => '123 Main St, Pimpri',
                'state_id' => 1,
                'district_id' => 1,
                'city_id' => 1,
                'establishment_date' => '2000-05-15',
                'contact_number' => '9876543210',
                'password' => Hash::make('admin123'),
                'login_id' => 1
            ],
            [
                'name' => 'Bright Future Academy',
                'address' => '456 Elm St, Thane',
                'state_id' => 1,
                'district_id' => 2,
                'city_id' => 3,
                'establishment_date' => '1995-08-20',
                'contact_number' => '9123456789',
                'password' => Hash::make('admin123'),
                'login_id' => 1
            ],
        ];

        foreach ($schools as $school) {
            School::create($school);
        }
    }
}
