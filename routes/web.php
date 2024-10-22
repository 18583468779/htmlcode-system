<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TipicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// 获取用户信息
Route::get('info', [UserController::class, 'info']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/logout', [AuthController::class, 'logout']);
// 创建帖子资源路由，排除create,edit方法
Route::resource('tipic', TipicController::class)->except(['create', 'edit']);
// 创建章节资源路由，排除create,edit方法
Route::resource('chapter', ChapterController::class)->except(['create', 'edit']);
// 创建课程资源路由，排除create,edit方法
Route::resource('lesson', LessonController::class)->except(['create', 'edit']);
// 创建视频资源路由，排除create,edit方法
Route::resource('video', controller: VideoController::class)->except(['create', 'edit', 'create', 'update']);
Route::post('video/{lesson}', [VideoController::class, 'store']);
Route::put('video', [VideoController::class, 'update']);
