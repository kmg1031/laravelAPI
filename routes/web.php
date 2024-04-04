<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;


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
    return view('index');
});


// 유저
Route::prefix('users')->group(function () {
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');

    Route::prefix('mypage')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->name('users.mypage.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.mypage.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.mypage.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.mypage.destroy');
    });
});

// login
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login.index');
    Route::post('/', [LoginController::class, 'loginProcess'])->name('login.process');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

// 게시글
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::middleware('auth')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
});
