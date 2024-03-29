<?php

use App\Http\Controllers\AdminPlaylistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Http\Controllers\InspireController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('inspire', [InspireController::class, 'index'])->name('inspire.index');
Route::get('inspire/{spotify_playlist_id}', [InspireController::class, 'show'])->name('inspire.show');

// Authenticated routes
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/playlists/new', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::get('/playlists/mine', [PlaylistController::class, 'mine'])->name('playlists.mine');

    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');

    Route::patch('/playlists/{playlist}/like', [PlaylistController::class, 'like'])->name('playlists.like');
    Route::patch('/playlists/{playlist}/dislike', [PlaylistController::class, 'dislike'])->name('playlists.dislike');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::name('admin.')->middleware(['auth', 'is.admin'])->group(function () {
    Route::get('/admin/playlists', [AdminPlaylistController::class, 'index'])->name('playlists.index');

    Route::patch('/admin/playlists/{playlist}/delete', [AdminPlaylistController::class, 'delete'])->name('playlists.delete');
    Route::patch('/admin/playlists/{playlist}/restore', [AdminPlaylistController::class, 'restore'])->name('playlists.restore');
});

require __DIR__ . '/auth.php';
