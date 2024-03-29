<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'playlist_id',
        'reaction_type_id',
    ];

    // Model Relationships -----------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }

    public function reactionType()
    {
        return $this->belongsTo(ReactionType::class);
    }


    // Model events -----------------------------------------------------------
    protected static function booted()
    {

        static::updated(function() {
            Cache::forget('welcome.trending_playlists');
            Cache::forget('dashboard.trending_playlists');
        });
    }
}
