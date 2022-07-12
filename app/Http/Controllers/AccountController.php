<?php

namespace App\Http\Controllers;

use App\Http\Requests\accountCreateRequest;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\Type;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return redirect(route('user.dashboard'));
    }

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
        $transactions = $user->accountsWithTypesAndTransactions;
        $data = [
            'userAccounts' => $user->accounts,
            'types' => AccountType::all(),
            'account' => $account,
            'transactions' => $transactions,
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

    public function update(Request $request, Account $account)
    {
        $this->validate($request, [
            'name' => ['required'],
            'balance' => ['nullable', 'numeric'],
            'alert' => ['nullable', 'numeric'],
            'type' => 'required',
        ]);

        $account->update([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Account::class, 'slug', $request->name),
            'account_type_id' => $request->type,
            'alert' => (int) ($request->alert * 100),
        ]);

        return redirect()->route('user.dashboard');
    }
}
