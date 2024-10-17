<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Chapter::factory(10)->has(Lesson::factory(5)->hasVideos(2))->create();
    }
}