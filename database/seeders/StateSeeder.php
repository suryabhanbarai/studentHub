<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Maharashtra'],
            ['name' => 'Gujarat'],
            ['name' => 'Karnataka'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
