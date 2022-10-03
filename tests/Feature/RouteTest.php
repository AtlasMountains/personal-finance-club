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
