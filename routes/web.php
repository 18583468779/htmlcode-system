<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TipicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// 获取用户信息
Route::get('info', [UserController::class, 'info']);
// 创建资源路由，排除create,edit方法
Route::resource('tipic', TipicController::class)->except(['create', 'edit']);

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::post('auth/logout', [AuthController::class, 'logout']);
