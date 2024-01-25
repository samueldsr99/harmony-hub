<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

test('Signin page is rendered properly', function () {
    $response = $this->get('/signin');

    $response->assertStatus(200);
});

test('Users can sign in', function () {
    $user = User::factory()->create();

    $response = $this->post('/signin', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('Reject authentication when password is invalid', function () {
    $user = User::factory()->create();

    $this->post('/signin', [
        'email' => $user->email,
        'password' => '123',
    ]);

    $this->assertGuest();
});

test('Users can sign out', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/signout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
