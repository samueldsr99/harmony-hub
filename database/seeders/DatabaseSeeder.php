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
        // Create if email doesn't exist
        \App\Models\User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'is_admin' => true
        ]);
        \App\Models\User::factory(10)->create();

        // Playlists and songs
        Playlist::factory()
            ->has(Song::factory(10))
            ->count(8)
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
