<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    //
    public function welcome(): View
    {
        $trending_playlists = Playlist::with('author')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        error_log($trending_playlists);

        return view('welcome', compact('trending_playlists'));
    }
}
