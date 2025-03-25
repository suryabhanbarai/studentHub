<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Standard;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $standards = [
            ['name' => '1st'],
            ['name' => '2nd'],
            ['name' => '3rd'],
            ['name' => '10th'],
            ['name' => '12th'],
        ];

        foreach ($standards as $standard) {
            Standard::create($standard);
        }
    }
}
