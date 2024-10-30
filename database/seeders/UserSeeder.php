<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(10)->hasTipics(3)->hasSigns()->has(Order::factory()->count(5)->for(Chapter::factory()))->create();
        // 修改第一个用户的信息
        $user = User::first();
        $user->name = 'admin';
        $user->password = Hash::make('admin888');
        $user->save();
    }
}
