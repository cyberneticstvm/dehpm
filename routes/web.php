<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::prefix('')->controller(AuthController::class)->group(function () {
        Route::get('/', 'checkLogin')->name('login');
        Route::post('/', 'login')->name('user.login');
    });
});
Route::middleware(['web', 'auth', 'auth.session'])->group(function () {
    Route::prefix('')->controller(AuthController::class)->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('force/logout', 'forceLogoutGet')->name('user.force.logout.get');
        Route::post('force/logout', 'forceLogout')->name('user.force.logout');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('user.register');
    });
});
