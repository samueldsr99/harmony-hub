<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'artist', 'genre'];

    // Model Relationships -----------------------------------------------------
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class)->withTimestamps();
    }
}
