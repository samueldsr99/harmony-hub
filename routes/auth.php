<?php

use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('signin', [SignInController::class, 'index'])->name('signin');
    Route::post('signin', [SignInController::class, 'store']);

    Route::get('signup', [SignUpController::class, 'index'])->name('signup');

    Route::post('signup', [SignUpController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [SignInController::class, 'destroy'])
        ->name('logout');
});
