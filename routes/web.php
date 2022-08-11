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

Route::get('/', function () {
    return Inertia::render('Public/PageIndex');
})->name('home');

Route::middleware('guest')->prefix('auth')->group(function (){
    Route::get('signIn', [\App\Http\Controllers\Auth\SignInController::class, 'create'])->name('login');
    Route::post('signIn', [\App\Http\Controllers\Auth\SignInController::class, 'store'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Auth\SignInController::class, 'destroy'])->name('logout');
    Route::get('logout', [\App\Http\Controllers\Auth\SignInController::class, 'destroy'])->name('logout');
});
