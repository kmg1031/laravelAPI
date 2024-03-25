<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// 유저 등록 양식을 표시하는 라우트
Route::get('/register', [UserController::class, 'create'])->name('register');

// 유저 등록 양식 제출을 처리하는 라우트
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// 게시글
Route::resource('posts', PostController::class)->middleware('auth');
