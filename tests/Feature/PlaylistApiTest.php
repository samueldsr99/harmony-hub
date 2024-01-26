<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaylistApiTest extends TestCase
{
    use RefreshDatabase;

    public function testPlaylistsAreBeingShown()
    {
        $response = $this->get('/api/v1/playlist');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'songs',
                    'author'
                ],
            ],
        ]);
    }

    public function testPlaylistDetailsIsBeingShown()
    {
        // Arrange
        $user = User::factory()->create();
        $user->playlists()->create(['title' => 'My second playlist']);

        $response = $this->get('/api/v1/playlist/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'songs',
                'author'
            ],
        ]);
    }

    public function testPlaylistCanBeDeleted()
    {
        // Arrange
        $user = User::factory()->create();
        $playlist = $user->playlists()->create(['title' => 'My third playlist']);

        // Act
        $response = $this->actingAs($user)->delete('/api/v1/playlist/' . $playlist->id);

        // Assert
        $response->assertStatus(200);
    }

    public function testPlaylistCanBeCreated()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)
            ->postJson('/api/v1/playlist',
                [
                    'title' => 'My fourth playlist',
                    'author_id' => $user->id,
                    'songs' => [
                        [
                            'title' => 'Song 1',
                            'author' => 'Author 1',
                            'genre' => 'Genre 1',
                        ],
                        [
                            'title' => 'Song 2',
                            'author' => 'Author 2',
                            'genre' => 'Genre 2',
                        ],
                    ],
                ]
            );

        // Assert
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'songs',
                'author'
            ],
        ]);
    }

    public function testPlaylistCanBeUpdated()
    {
        // Arrange
        $user = User::factory()->create();
        $playlist = $user->playlists()->create(['title' => 'My third playlist']);

        // Act
        $response = $this->actingAs($user)->putJson('/api/v1/playlist/' . $playlist->id, [
            'title' => 'My updated playlist',
        ]);
        // Assert
        $response->assertStatus(200);
    }
}
