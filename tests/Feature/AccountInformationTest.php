<?php

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\User;
use App\Services\AccountInformationService;
use App\Services\FormatNumberService;

it('calculates account balance correctly', function () {
    $accountType = AccountType::create(['type' => 'checking']);
    $user = User::factory()->create();
    $account = Account::factory()->create([
        'user_id' => $user->id,
        //        'start_balance' => 43.56,
        'account_type_id' => $accountType->id,
    ]);

    $type = Type::create([
        'type' => 'testType',
    ]);

    $amount1 = 25.56;
    $amount2 = 37.1;
    $amount3 = -74.34;

    Transaction::create([
        'amount' => $amount1,
        'recipient' => 'dirk',
        'message' => 'test1',
        'date' => now(),
        'type_id' => $type->id,
        'account_id' => $account->id,
    ]);
    Transaction::create([
        'amount' => $amount2,
        'recipient' => 'bert',
        'message' => 'test2',
        'date' => now(),
        'type_id' => $type->id,
        'account_id' => $account->id,
    ]);
    Transaction::create([
        'amount' => $amount3,
        'recipient' => 'sam',
        'message' => 'test3',
        'date' => now(),
        'type_id' => $type->id,
        'account_id' => $account->id,
    ]);

    $accountInfoSvc = new AccountInformationService($account);
    $accountCalculatedBalance = $accountInfoSvc->getBalance();
    $formatSvc = new FormatNumberService();

    expect($accountCalculatedBalance)->tobe(
        $formatSvc->getFormatedNumber(
            $account->start_balance + $amount1 + $amount2 + $amount3,
            style: NumberFormatter::CURRENCY)
    );
});
