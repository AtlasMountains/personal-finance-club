<?php

use App\Models\Account;
use App\Models\AccountType;
use App\Models\User;

test('homepage exists', function () {
    $this->get(route('home'))->assertStatus(200);
});

test('login is accessible as guest', function () {
    $this->get(route('login'))->assertStatus(200);
});

test('login is not accessible as logged-in user', function () {
    $user = User::factory()->create();
    actingAs($user)->get(route('login'))->assertStatus(302);
});

test('register is accessible as guest', function () {
    $this->get(route('register'))->assertStatus(200);
});

test('register is not accessible as logged-in user', function () {
    $user = User::factory()->create();
    actingAs($user)->get(route('register'))->assertStatus(302);
});

test('dashboard is not accessible as guest', function () {
    $this->get(route('user.dashboard'))->assertStatus(302);
});

test('dashboard is not accessible for not verified users ', function () {
    $user = User::factory()->unverified()->create();
    actingAs($user)->get(route('user.dashboard'))->assertStatus(302);
});

test('dashboard is accessible for verified users ', function () {
    $user = User::factory()->create();
    actingAs($user)->get(route('user.dashboard'))->assertStatus(200);
});

test('account redirects to dashboard', function () {
    $userVerified = User::factory()->create();

    actingAs($userVerified)->get(route('account'))
        ->assertStatus(302)
        ->assertRedirect(route('user.dashboard'));
});

test('dashboard & account for unverified users redirects to verification screen', function () {
    $userUnverified = User::factory()->unverified()->create();
    actingAs($userUnverified)->get(route('account'))
        ->assertStatus(302)
        ->assertRedirect(route('user.dashboard'));

    actingAs($userUnverified)->get(route('user.dashboard'))
        ->assertStatus(302)
        ->assertRedirect(route('verification.notice'));
});

test('specific account is not accessible as a guest', function () {
    $accountType = AccountType::create(['type' => 'checking']);
    $user = User::factory()->create();
    $account = Account::factory()->create([
        'user_id' => $user->id,
        //        'start_balance' => 43.56,
        'account_type_id' => $accountType->id,
    ]);
    $this->get('/account/'.$account->slug)
        ->assertStatus(302);
});
