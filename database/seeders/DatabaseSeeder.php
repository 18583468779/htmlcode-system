<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ChapterSeeder::class,
            PackageSeeder::class
        ]);
    }
}
