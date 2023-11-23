<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
final class PlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'slug' => fake()->slug(5),
            'author_id' => function() {
                return User::all()->random(1)->first()->id;
            },
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Playlist $playlist) {
            $url = 'https://source.unsplash.com/random/1200x800';
            $playlist
                ->addMediaFromUrl($url)
                ->toMediaCollection();
        });
    }
}
