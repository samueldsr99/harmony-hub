<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $trending_playlists = Cache::remember('dashboard.trending_playlists', config('app.cache_ttl'), function() {
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

        return view('dashboard', compact('trending_playlists'));
    }
}
