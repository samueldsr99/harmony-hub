<?php

use App\Models\User;

test('Playlists for a user are being displayed', function () {
    // Arrange
    $user = User::factory()->create();
    $user->playlists()->createMany([
        ['title' => 'My first playlist'],
        ['title' => 'My second playlist'],
    ]);

    // Act
    $response = $this->actingAs($user)->get('/playlists/mine');

    // Assert
    $response->assertStatus(200);
    $response->assertSee('My first playlist');
    $response->assertSee('My second playlist');
});

test('Playlist details is being displayed', function () {
    // Arrange
    $user = User::factory()->create();
    $playlist = $user->playlists()->create(['title' => 'My first playlist']);

    // Act
    $response = $this->actingAs($user)->get('/playlists/record/' . $playlist->slug);

    // Assert
    $response->assertStatus(200);
    $response->assertSee('My first playlist');
});
