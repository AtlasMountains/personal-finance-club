<?php

use App\Models\Account;

test('homepage exists', function () {
    $this->get(route('home'))->assertStatus(200);
});

test('login is accessible as guest', function () {
    $this->get(route('login'))->assertStatus(200);
});

test('register is accessible as guest', function () {
    $this->get(route('register'))->assertStatus(200);
});

test('dashboard is not accessible as guest', function () {
    $this->get(route('user.dashboard'))->assertStatus(302);
});

test('account is not accessible', function () {
    $this->get(route('account'))
        ->assertStatus(302);
});

test('specific account is not accessible as a guest', function () {
    $accountSlug = Account::first()->slug;
    $this->get('/account/'.$accountSlug)
        ->assertStatus(302);
});
