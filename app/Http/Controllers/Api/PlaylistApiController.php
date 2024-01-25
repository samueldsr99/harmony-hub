<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaylistRequest;
use App\Http\Requests\PlaylistUpdateRequest;
use App\Http\Resources\PlaylistResource;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlaylistApiController extends Controller
{
    public function index()
    {
        return PlaylistResource::collection(Playlist::with('songs')->paginate(25));
    }

    public function show(int $playlist_id)
    {
        try {
            $playlist = Playlist::with('songs')->findOrFail($playlist_id);
            return new PlaylistResource($playlist);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Playlist not found',
            ], 404);
        }
    }

    public function store(PlaylistRequest $request)
    {
        try {
            $playlist = Playlist::create($request->all());
            return new PlaylistResource($playlist);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Playlist not found',
            ], 404);
        }
    }

    public function update(PlaylistUpdateRequest $request)
    {
        try {
            $playlist = Playlist::findOrFail($request->playlist_id);
            $playlist->update($request->all());
            return new PlaylistResource($playlist);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Playlist not found',
            ], 404);
        }
    }

    public function destroy(int $playlist_id)
    {
        try {
            $playlist = Playlist::findOrFail($playlist_id);
            $playlist->delete();
            return response()->json([
                'message' => 'Playlist deleted',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Playlist not found',
            ], 404);
        }
    }
}
