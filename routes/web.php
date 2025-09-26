<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::prefix('')->controller(AuthController::class)->group(function () {
        Route::get('/', 'checkLogin')->name('login');
        Route::post('/', 'login')->name('user.login');
    });
});
Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix('')->controller(AuthController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/logout', 'logout')->name('logout');
    });
});
