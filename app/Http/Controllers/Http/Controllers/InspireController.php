<?php

namespace App\Http\Controllers\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SpotifyService;
use Illuminate\View\View;

class InspireController extends Controller
{
    private $spotify_service;


    public function __construct(SpotifyService $spotify_service)
    {
        $this->spotify_service = $spotify_service;
    }

    public function index(): View
    {
        $playlists = $this->spotify_service->getFeaturedPlaylists()['playlists'];
        return view('site.inspire.index', compact('playlists'));
    }

    public function show(string $spotify_playlist_id): View
    {
        $playlist = $this->spotify_service->getPlaylist($spotify_playlist_id);
//        dd($playlist);
        return view('site.inspire.show', compact('playlist'));
    }
}
