<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankTransferController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\IncomeExpenseController;
use App\Http\Controllers\ManSupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDirectorController;
use App\Http\Controllers\PurchaseController;
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
        Route::get('hsn', 'hsn')->name('hsn');
        Route::get('products', 'products')->name('products');
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

    Route::prefix('head')->controller(HeadController::class)->group(function () {
        Route::get('', 'index')->name('head.register');
        Route::get('create', 'create')->name('head.create');
        Route::post('create', 'store')->name('head.save');
        Route::get('edit/{id}', 'edit')->name('head.edit');
        Route::post('edit/{id}', 'update')->name('head.update');
        Route::get('delete/{id}', 'destroy')->name('head.delete');
        Route::get('restore/{id}', 'restore')->name('head.restore');
    });

    Route::prefix('ie')->controller(IncomeExpenseController::class)->group(function () {
        Route::get('{type}', 'index')->name('ie.register');
        Route::get('create/{type}', 'create')->name('ie.create');
        Route::post('create/{type}', 'store')->name('ie.save');
        Route::get('edit/{id}/{type}', 'edit')->name('ie.edit');
        Route::post('edit/{id}/{type}', 'update')->name('ie.update');
        Route::get('delete/{id}/{type}', 'destroy')->name('ie.delete');
        Route::get('restore/{id}/{type}', 'restore')->name('ie.restore');
    });

    Route::prefix('btransfer')->controller(BankTransferController::class)->group(function () {
        Route::get('', 'index')->name('btransfer.register');
        Route::get('create', 'create')->name('btransfer.create');
        Route::post('create', 'store')->name('btransfer.save');
        Route::get('edit/{id}', 'edit')->name('btransfer.edit');
        Route::post('edit/{id}', 'update')->name('btransfer.update');
        Route::get('delete/{id}', 'destroy')->name('btransfer.delete');
        Route::get('restore/{id}', 'restore')->name('btransfer.restore');
    });

    Route::prefix('ms')->controller(ManSupController::class)->group(function () {
        Route::get('{type}', 'index')->name('ms.register');
        Route::get('create/{type}', 'create')->name('ms.create');
        Route::post('create/{type}', 'store')->name('ms.save');
        Route::get('edit/{id}/{type}', 'edit')->name('ms.edit');
        Route::post('edit/{id}/{type}', 'update')->name('ms.update');
        Route::get('delete/{id}/{type}', 'destroy')->name('ms.delete');
        Route::get('restore/{id}/{type}', 'restore')->name('ms.restore');
    });

    Route::prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('hsn', 'hsn')->name('product.hsn');
        Route::get('{hsn}', 'index')->name('product.register');
        Route::get('create/{hsn}', 'create')->name('product.create');
        Route::post('create/{hsn}', 'store')->name('product.save');
        Route::get('edit/{id}/{hsn}', 'edit')->name('product.edit');
        Route::post('edit/{id}/{hsn}', 'update')->name('product.update');
        Route::get('delete/{id}/{hsn}', 'destroy')->name('product.delete');
        Route::get('restore/{id}/{hsn}', 'restore')->name('product.restore');
    });

    Route::prefix('purchase')->controller(PurchaseController::class)->group(function () {
        Route::get('', 'index')->name('purchase.register');
        Route::get('create', 'create')->name('purchase.create');
        Route::post('create', 'store')->name('purchase.save');
        Route::get('edit/{id}', 'edit')->name('purchase.edit');
        Route::post('edit/{id}', 'update')->name('purchase.update');
        Route::get('delete/{id}', 'destroy')->name('purchase.delete');
        Route::get('restore/{id}', 'restore')->name('purchase.restore');
    });
});
