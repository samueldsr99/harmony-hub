<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    //
    public function welcome(): View
    {
        $trending_playlists = Cache::remember('welcome.trending_playlists', config('app.cache_ttl'), function() {
            return Playlist::with(['author', 'reactions' => function ($query) {
                $query->where('reaction_type_id', 1);
            }])
                ->withCount(['reactions as reaction_count' => function ($query) {
                    $query->where('reaction_type_id', 1);
                }])
                ->orderByDesc('reaction_count')
                ->take(5)
                ->get();
        });

        return view('welcome', compact('trending_playlists'));
    }
}
