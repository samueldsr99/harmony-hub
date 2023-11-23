<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PlaylistController extends Controller
{
    //
    public function index(): View
    {
        $playlists = Playlist::query()
            ->with(['songs', 'author', 'media'])
            ->orderBy('created_at', 'desc')->get();

        return view('site.playlists.index', [
            'playlists' => $playlists,
        ]);
    }

    public function create(): View
    {
        $genres = config('genres.genres');
        return view('site.playlists.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:20'],
            'songs' => ['required', 'array'],
            'songs.*.title' => ['required', 'string'],
            'songs.*.author' => ['required', 'string'],
            'songs.*.genre' => ['required', 'string'],
            'image' => ['file'],
        ]);

        $playlist = Playlist::create([
            'title' => $request->title,
            'author_id' => auth()->id(),
        ]);

        $songsData = collect($request->songs)->map(function ($song) {
            return [
                'title' => $song['title'],
                'artist' => $song['author'],
                'genre' => $song['genre']
            ];
        });

        $playlist->songs()->createMany($songsData->toArray());

        if($request->hasFile('image')) {
            $playlist->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('playlists.index');
    }

    public function show(Playlist $playlist): View
    {
        return view('site.playlists.show', [
            'playlist' => $playlist,
        ]);
    }
}
