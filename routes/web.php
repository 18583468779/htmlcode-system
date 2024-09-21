<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TipicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// 创建资源路由，排除create,edit方法
Route::resource('tipic', TipicController::class)->except(['create', 'edit']);

Route::post('login', [AuthController::class, 'login']);