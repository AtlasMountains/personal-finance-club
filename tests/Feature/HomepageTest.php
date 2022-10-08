<?php

test('homepage shows the title', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSeeText('The personal finance club');
});

test('homepage shows a link to github', function () {
    $this->get('/')
        ->assertseetext('Github')
        ->assertSee('https://github.com/AtlasMountains/personal-finance-club');
});

test('homepage shows get started button', function () {
    $dashboardURL = env('APP_URL').'/dashboard';
    $this->get('/')
        ->assertSeeText('Get Started')
        ->assertSee($dashboardURL);
});

test('navigation links are present', function () {
    $homeURL = env('APP_URL').'/login';
    $loginURL = env('APP_URL').'/register';
    $registerURL = env('APP_URL');
    $this->get('/')
        ->assertStatus(200)
        ->assertSee($homeURL)
        ->assertSee($loginURL)
        ->assertSee($registerURL);
});
