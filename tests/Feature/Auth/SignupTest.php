<?php

test('Signup page is rendered properly', function () {
    $response = $this->get('/signup');

    $response->assertStatus(200);
});

test('Users can sign up', function () {
    $response = $this->post('/signup', [
        'name' => 'John Doe',
        'email' => 'john.doe123@gmail.com',
        'password' => 'JohnDoe123*',
        'password_confirmation' => 'JohnDoe123*'
    ]);

    $response->assertRedirect(RouteServiceProvider::HOME);
});
