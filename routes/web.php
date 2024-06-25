<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\MenusController;


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
})->name('index');


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

// 로그인
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login.index');
    Route::post('/', [LoginController::class, 'loginProcess'])->name('login.process');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

// 게시글
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/show/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::middleware('auth')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/update/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
});

// shops
Route::prefix('shops')->group(function () {
    Route::get('/', [ShopsController::class, 'index'])->name('shops.index');
    Route::get('/show/{shops}', [ShopsController::class, 'show'])->name('shops.show');

    // Route::middleware('auth')->group(function () {
        Route::get('/create', [ShopsController::class, 'create'])->name('shops.create');
        Route::post('/store', [ShopsController::class, 'store'])->name('shops.store');
        Route::get('/edit/{shops}', [ShopsController::class, 'edit'])->name('shops.edit');
        Route::put('/update/{shops}', [ShopsController::class, 'update'])->name('shops.update');
        Route::delete('/destroy/{shops}', [ShopsController::class, 'destroy'])->name('shops.destroy');
    // });

    // menus
    Route::prefix('{shop}/menus')->group(function () {
        Route::get('/', [MenusController::class, 'index'])->name('shops.menus.index');
        Route::get('/create', [MenusController::class, 'create'])->name('shops.menus.create');
        Route::post('/store', [MenusController::class, 'store'])->name('shops.menus.store');
        Route::get('/show/{menu}', [MenusController::class, 'show'])->name('shops.menus.show');
        Route::get('/edit/{menu}', [MenusController::class, 'edit'])->name('shops.menus.edit');
        Route::put('/update/{menu}', [MenusController::class, 'update'])->name('shops.menus.update');
        Route::delete('/destroy/{menu}', [MenusController::class, 'destroy'])->name('shops.menus.destroy');
    });
});

