<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
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

    Route::prefix('ajax')->controller(AjaxController::class)->group(function () {
        Route::get('edit', 'edit')->name('edit');
    });

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('user.register');
        Route::post('save', 'store')->name('user.save');
        Route::post('update', 'update')->name('user.update');
        Route::get('delete/{id}', 'destroy')->name('user.delete');
        Route::get('restore/{id}', 'restore')->name('user.restore');
    });

    Route::prefix('branch')->controller(BranchController::class)->group(function () {
        Route::get('', 'index')->name('branch.register');
        Route::post('save', 'store')->name('branch.save');
        Route::post('update', 'update')->name('branch.update');
        Route::get('delete/{id}', 'destroy')->name('branch.delete');
        Route::get('restore/{id}', 'restore')->name('branch.restore');
    });
});
