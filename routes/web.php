<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('post/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])
    ->middleware(['postViewOnlyAuth'])
    ->name('post.slug');

Route::middleware('guest')->prefix('auth')->group(function (){
    Route::get('signIn', [\App\Http\Controllers\Auth\SignInController::class, 'create'])->name('login');
    Route::post('signIn', [\App\Http\Controllers\Auth\SignInController::class, 'store'])->name('login');
    Route::get('signUp', [\App\Http\Controllers\Auth\SignUpController::class, 'create'])->name('register');
    Route::post('signUp', [\App\Http\Controllers\Auth\SignUpController::class, 'store'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Auth\SignInController::class, 'destroy'])->name('logout');
    Route::get('logout', [\App\Http\Controllers\Auth\SignInController::class, 'destroy'])->name('logout');
    //Пости авторизованого користувача
    Route::get('my-posts', [\App\Http\Controllers\UserPostsController::class, 'index'])->name('my.posts');
});
