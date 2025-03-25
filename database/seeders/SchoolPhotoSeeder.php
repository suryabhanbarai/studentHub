<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolPhoto;

class SchoolPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            $photos = [
                ['school_id' => 1, 'photo_path' => 'school_photos/springdale1.jpg'],
                ['school_id' => 1, 'photo_path' => 'school_photos/springdale2.jpg'],
                ['school_id' => 2, 'photo_path' => 'school_photos/brightfuture1.jpg'],
            ];
    
            foreach ($photos as $photo) {
                SchoolPhoto::create($photo);
            }
    }
}
