<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::prefix('')->controller(AuthController::class)->group(function () {
        Route::get('/', 'checkLogin')->name('login');
        Route::post('/', 'login')->name('user.login');
    });
});

Route::middleware(['web', 'auth', 'auth.session'])->group(function () {
    Route::prefix('dashboard')->controller(AuthController::class)->group(function () {
        Route::get('', 'dashboard')->name('dashboard');
        Route::post('update/branch', 'updateBranch')->name('user.branch.update');
    });
});

Route::middleware(['web', 'auth', 'auth.session', 'branch'])->group(function () {
    Route::prefix('')->controller(AuthController::class)->group(function () {
        Route::get('loginlog', 'loginLog')->name('user.login.log');
        Route::get('force/logout', 'forceLogoutGet')->name('user.force.logout.get');
        Route::post('force/logout', 'forceLogout')->name('user.force.logout');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::prefix('ajax')->controller(AjaxController::class)->group(function () {
        Route::get('edit', 'edit')->name('edit');
    });

    Route::prefix('role')->controller(RoleController::class)->group(function () {
        Route::get('', 'index')->name('role.register');
        Route::get('create', 'create')->name('role.create');
        Route::post('create', 'store')->name('role.save');
        Route::get('edit/{id}', 'edit')->name('role.edit');
        Route::post('edit/{id}', 'update')->name('role.update');
        Route::get('delete/{id}', 'destroy')->name('role.delete');
    });

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('user.register');
        Route::get('create', 'create')->name('user.create');
        Route::post('create', 'store')->name('user.save');
        Route::get('edit/{id}', 'edit')->name('user.edit');
        Route::post('edit/{id}', 'update')->name('user.update');
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
