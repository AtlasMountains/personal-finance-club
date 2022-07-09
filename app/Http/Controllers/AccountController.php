<?php

namespace App\Http\Controllers;

use App\Http\Requests\accountCreateRequest;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function create()
    {
        return view('accounts.create', ['types' => AccountType::all()]);
    }

    public function store(accountCreateRequest $request)
    {
        Account::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'account_type_id' => $request->type,
            'start_balance' => (int) ($request->balance * 100),
            'alert' => (int) ($request->alert * 100),
        ]);

        return redirect()->route('user.dashboard');
    }

    public function show(Account $account)
    {
        $user = auth()->user();
        $data = [
            'userAccounts' => $user->accounts,
            'types' => AccountType::all(),
            'account' => $account,
        ];

        return view('accounts.show', $data);
    }

    public function edit($account)
    {
        return view('accounts.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('user.dashboard');
    }
}
