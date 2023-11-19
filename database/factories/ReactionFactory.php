<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\ReactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random(1)->first()->id,
            'playlist_id' => Playlist::all()->random(1)->first()->id,
            'reaction_type_id' => ReactionType::all()->random(1)->first()->id,
        ];
    }
}
