<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthorizationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

Route::prefix('dashboard')
    ->middleware('login')
    ->group(function () {
    Route::get('/', [AdminController::class, 'index'])
        ->name('admin');
});
