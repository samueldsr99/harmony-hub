<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('playlists/record/{playlist:slug}', [PlaylistController::class, 'show'])->name('playlists.show');



// Authenticated routes
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::get('/playlists/new', [PlaylistController::class, 'create'])->name('playlists.create');

    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
});

require __DIR__.'/auth.php';
