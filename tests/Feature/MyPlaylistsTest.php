<?php

use App\Models\User;

test('playlists for a user are being displayed', function () {
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
