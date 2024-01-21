<?php

use App\Models\User;

test('users page is being displayed', function () {
    // Arrange
    $user = User::factory()->count(2)->create();

    // Act
    $response = $this->get('/users');

    // Assert
    $response->assertStatus(200);

    $first_user = $user->first();
    $response->assertSee($first_user->name);

    $second_user = $user->last();
    $response->assertSee($second_user->name);
});
