<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class Playlist extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['title', 'author_id'];

    // Model events -----------------------------------------------------------
    protected static function booted()
    {
        static::creating(function ($playlist) {
            $playlist->slug = $playlist->slug ?? $playlist->createUniqueSlug();
        });
    }

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

    // Model attributes --------------------------------------------------------
    public function getThumbnailUrlAttribute(): string
    {
        return $this->getImageUrl('thumbnail');
    }

    // Model method ------------------------------------------------------------------
    public function getImageUrl(string $conversion): string
    {
        return ($this->media->isNotEmpty())
            ? $this->media->first()->getUrl($conversion)
            : '/media/default/conversions/default-'.$conversion.'.jpg';
    }

    // Medialibrary settings ----------------------------------------------------------
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 200)
            ->nonQueued();
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Manipulations::FIT_CROP, 50, 50)
            ->nonQueued();

    }

    public function createUniqueSlug(): string
    {
        $nr = 0;
        do {
            $slug = ($nr === 0)
                ? Str::slug($this->title)
                : Str::slug($this->title).'-'.$nr;
            $nr++;
        } while (Playlist::where('slug', $slug)->where('id', '<>', $this->id)->count() > 0);

        return $slug;
    }
}
