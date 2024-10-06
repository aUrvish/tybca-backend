<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::insert([
            [
                "name" => "Data Science",
                "primary_color" => "#BD39FC"
            ],
            [
                "name" => "Artificial Intelligence",
                "primary_color" => "#FD3C3C"
            ],
            [
                "name" => "Big Data",
                "primary_color" => "#1F75F7"
            ],
            [
                "name" => "Cloud Computing",
                "primary_color" => "#1F75F7"
            ],
            [
                "name" => "Project Management",
                "primary_color" => "#00BFFB"
            ],
            [
                "name" => "Networking",
                "primary_color" => "#0AE1A1"
            ],
            [
                "name" => "Software Development",
                "primary_color" => "#FF9432"
            ]
        ]);
    }
}
