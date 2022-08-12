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
    ->name('post.show');

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
    //Керування постами
    Route::get('post/blog/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('post', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('post/{post}/delete', [\App\Http\Controllers\PostController::class, 'destroy'])
        ->middleware(['can:delete,post'])
        ->name('post.destroy');
    Route::resource('post', \App\Http\Controllers\PostController::class)
        ->middleware(['can:update,post', 'can:edit,post'])
        ->except(['show', 'create', 'store', 'destroy']);
    //Видалення фото
    Route::get('image/{image}/delete', [\App\Http\Controllers\ImageFController::class, 'destroy'])
        ->name('image.destroy');
    //Адмінка
    Route::prefix('dashboard')->name('dashboard.')->group(function (){
        Route::get('/', \App\Http\Controllers\Admin\AdminController::class)->name('home');
    });
    //Відправка повідомлення автору
    Route::post('message', [\App\Http\Controllers\MessageController::class, 'store'])->name('message.store');
    Route::get('messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('message.index');
    Route::get('messages/{id}/read', [\App\Http\Controllers\MessageController::class, 'read'])
        ->name('message.read');
});
