<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'school_id' => 1,
                'name' => 'John Doe',
                'standard_id' => 1,
                'gender' => 'male',
                'year' => 2023,
                'photo_path' => 'student_photos/john_doe.jpg',
            ],
            [
                'school_id' => 1,
                'name' => 'Jane Smith',
                'standard_id' => 2,
                'gender' => 'female',
                'year' => 2023,
                'photo_path' => 'student_photos/jane_smith.jpg',
            ],
            [
                'school_id' => 2,
                'name' => 'Amit Patel',
                'standard_id' => 3,
                'gender' => 'male',
                'year' => 2024,
                'photo_path' => 'student_photos/amit_patel.jpg',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
