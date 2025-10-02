<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDirectorController;
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
        Route::get('switch/{id}', 'switchBranch')->name('user.branch.switch');
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

    Route::prefix('project')->controller(ProjectController::class)->group(function () {
        Route::get('', 'index')->name('project.register');
        Route::get('create', 'create')->name('project.create');
        Route::post('create', 'store')->name('project.save');
        Route::get('edit/{id}', 'edit')->name('project.edit');
        Route::post('edit/{id}', 'update')->name('project.update');
        Route::get('delete/{id}', 'destroy')->name('project.delete');
        Route::get('restore/{id}', 'restore')->name('project.restore');
    });

    Route::prefix('director')->controller(DirectorController::class)->group(function () {
        Route::get('', 'index')->name('director.register');
        Route::get('create', 'create')->name('director.create');
        Route::post('create', 'store')->name('director.save');
        Route::get('edit/{id}', 'edit')->name('director.edit');
        Route::post('edit/{id}', 'update')->name('director.update');
        Route::get('delete/{id}', 'destroy')->name('director.delete');
        Route::get('restore/{id}', 'restore')->name('director.restore');
    });

    Route::prefix('prodir')->controller(ProjectDirectorController::class)->group(function () {
        Route::get('', 'index')->name('project.director.register');
        Route::get('create', 'create')->name('project.director.create');
        Route::post('create', 'store')->name('project.director.save');
        Route::get('edit/{id}', 'edit')->name('project.director.edit');
        Route::post('edit/{id}', 'update')->name('project.director.update');
        Route::get('delete/{id}', 'destroy')->name('project.director.delete');
        Route::get('restore/{id}', 'restore')->name('project.director.restore');
    });
});
