<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;
use App\Http\Requests\accountCreateRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

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

    public function edit(Account $account)
    {
        $data = [
            'account' => $account,
            'types' => Type::all(),
        ];
        return view('accounts.edit', $data);
    }

    public function update(accountCreateRequest $request, Account $account)
    {
        $account->update([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Account::class, 'slug', $request->name),
            'account_type_id' => $request->type,
            'alert' => (int) ($request->alert * 100),
        ]);

        return redirect()->route('user.dashboard');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('user.dashboard');
    }
}
