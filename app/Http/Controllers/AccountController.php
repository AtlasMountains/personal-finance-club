<?php

namespace App\Http\Controllers;

use App\Http\Requests\accountCreateRequest;
use App\Models\Account;
use App\Models\AccountType;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AccountController extends Controller
{
    public function index(): Redirector|Application|RedirectResponse
    {
        return redirect(route('user.dashboard'));
    }

    public function create(): Factory|View|Application
    {
        return view('accounts.create', ['types' => AccountType::all()]);
    }

    public function store(accountCreateRequest $request): RedirectResponse
    {
        Account::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'account_type_id' => $request->type,
            'start_balance' => (int)($request->balance * 100),
            'alert' => (int)($request->alert * 100),
            'position' => auth()->user()->accounts->max('position') + 1,
        ]);

        return redirect()->route('user.dashboard');
    }

    public function show(Account $account): Factory|View|Application
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

    public function edit(Account $account): Factory|View|Application
    {
        $data = [
            'account' => $account,
            'types' => AccountType::all(),
        ];

        return view('accounts.edit', $data);
    }

    public function update(Request $request, Account $account): RedirectResponse
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
            'alert' => (int)($request->alert * 100),
        ]);

        return redirect()->route('user.dashboard');
    }
}
