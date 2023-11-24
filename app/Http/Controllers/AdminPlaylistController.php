<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminPlaylistController extends Controller
{
    //
    public function index(): View
    {
        $playlists = Playlist::withTrashed()->with('author')->orderBy('created_at', 'desc')->get();

        return view('site.admin.playlists.index', compact('playlists'));
    }

    public function delete(Playlist $playlist): RedirectResponse
    {
        $playlist->delete();

        return redirect()->route('admin.playlists.index');
    }

    public function restore(int $playlistId): RedirectResponse
    {
        Playlist::onlyTrashed()->findOrFail($playlistId)->restore();

        return redirect()->route('admin.playlists.index');
    }
}
