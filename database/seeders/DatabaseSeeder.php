<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Playlist;
use App\Models\Reaction;
use App\Models\Song;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);
        \App\Models\User::factory(10)->create();

        // Playlists and songs
        Playlist::factory()
            ->has(Song::factory(10))
            ->count(20)
            ->create();

        // Reaction types
        \App\Models\ReactionType::factory()->createMany([
            ['name' => 'like'],
            ['name' => 'dislike'],
        ]);

        // Reactions
        Reaction::factory()->count(120)->create();
    }
}
