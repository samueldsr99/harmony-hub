<?php

use App\Http\Controllers\Api\PlaylistApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/v1/playlist', [PlaylistApiController::class, 'index']);
Route::get('/v1/playlist/{playlist_id}', [PlaylistApiController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/v1/playlist', [PlaylistApiController::class, 'store']);
    Route::put('/v1/playlist', [PlaylistApiController::class, 'update']);
    Route::delete('/v1/playlist/{playlist_id}', [PlaylistApiController::class, 'destroy']);
});

