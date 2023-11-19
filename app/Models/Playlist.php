<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id'];

    // Model Relationships -----------------------------------------------------
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function songs()
    {
        return $this->belongsToMany(
            Song::class,
            'playlist_songs',
            'playlist_id',
            'song_id'
        )->withTimestamps();
    }
}
