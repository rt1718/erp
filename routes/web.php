<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    abort(404);
});

Route::prefix('login')
    ->middleware('guest')
    ->group(function () {
        Route::get('/', [AuthorizationController::class, 'index'])
            ->name('login');
        Route::post('/', [AuthorizationController::class, 'login'])
            ->name('login.post');
    });

Route::get('/logout', [LogoutController::class, 'logout'])
    ->name('logout');

Route::prefix('admin')
    ->middleware('login')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('admin');
        Route::resource('/products', ProductController::class);
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    });
