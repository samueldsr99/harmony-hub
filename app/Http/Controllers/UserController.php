<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(User $user): View
    {
        $playlists = Playlist::with(['author', 'songs'])
            ->where('author_id', $user->id)
            ->get();
        return view('site.users.show', compact('user', 'playlists'));
    }
}
