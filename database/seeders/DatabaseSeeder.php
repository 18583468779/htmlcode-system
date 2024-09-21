<?php

namespace Database\Seeders;

use App\Models\Tipic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // 修改第一个用户的信息
        $user = User::first();
        $user->name = 'admin';
        $user->password = Hash::make('admin888');
        $user->save();
        Tipic::factory(30)->create();
    }
}