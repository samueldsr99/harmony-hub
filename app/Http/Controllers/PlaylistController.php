<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Reaction;
use App\Models\ReactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    public function mine(): View
    {
        error_log(auth()->id());
        $playlists_mine = Playlist::query()
            ->where(['author_id' => auth()->id()])
            ->with(['songs', 'author', 'media'])
            ->orderBy('created_at', 'desc')->get();

        return view('site.playlists.mine', [
            'playlists' => $playlists_mine,
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
        } else {
            $defaultImageUrl = 'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg';
            $playlist->addMediaFromUrl($defaultImageUrl)->toMediaCollection();
        }

        return redirect()->route('playlists.mine');
    }

    public function show(Playlist $playlist): View
    {
        $reaction = Reaction::where('playlist_id', $playlist->id)->where('user_id', auth()->id())->first();
        $likes = Reaction::where('playlist_id', $playlist->id)->where('reaction_type_id', 1)->count();
        $dislikes = Reaction::where('playlist_id', $playlist->id)->where('reaction_type_id', 2)->count();

        return view('site.playlists.show', [
            'playlist' => $playlist,
            'reaction_type_id' => $reaction?->reaction_type_id ?? 0,
            'likes' => $likes,
            'dislikes' => $dislikes,
        ]);
    }

    public function destroy(Playlist $playlist): RedirectResponse
    {
        $this->checkIfUserHasAccess($playlist);

        $playlist->delete();

        return redirect()->route('playlists.mine');
    }

    public function like(Playlist $playlist): RedirectResponse
    {
        $this->checkIfUserHasAccess($playlist);

        Reaction::updateOrCreate(
            ['user_id' => auth()->id(), 'playlist_id' => $playlist->id],
            ['reaction_type_id' => 1]
        );

        Cache::forget('welcome.trending_playlists');
        Cache::forget('dashboard.trending_playlists');

        return redirect()->back();
    }

    public function dislike(Playlist $playlist): RedirectResponse
    {
        $this->checkIfUserHasAccess($playlist);

        Reaction::updateOrCreate(
            ['user_id' => auth()->id(), 'playlist_id' => $playlist->id],
            ['reaction_type_id' => 2]
        );

        Cache::forget('welcome.trending_playlists');
        Cache::forget('dashboard.trending_playlists');

        return redirect()->back();
    }

    private function checkIfUserHasAccess(Playlist $playlist)
    {
        if( auth()->id() !== $playlist->author_id) {
            session()->flash('error_notification', "You're not authorized to make this action");
            return redirect()->back();
        }
    }
}
