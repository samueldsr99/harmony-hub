<?php

test('Signup page is rendered properly', function () {
    $response = $this->get('/signup');

    $response->assertStatus(200);
});

