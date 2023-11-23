<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id'];

    // Model Relationships -----------------------------------------------------
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(
            Song::class,
            'playlist_songs',
            'playlist_id',
            'song_id'
        )->withTimestamps();
    }
}
