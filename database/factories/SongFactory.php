<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
final class SongFactory extends Factory
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
            'artist' => fake()->name(),
            'album' => fake()->sentence(),
            'duration' => fake()->randomFloat(2, 1, 5),
            'genre' => fake()->randomElement(config('genres.genres')),
        ];
    }
}
