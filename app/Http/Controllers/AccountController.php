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
        if ($request->addFamily) {
            $familyId = auth()->user()->family_id;
        }
        Account::create($request->validated() + [
            'user_id' => auth()->user()->id,
            'account_type_id' => $request->type,
            'position' => auth()->user()->accounts->max('position') + 1,
            'family_id' => $familyId ?? null,
        ]);

        return redirect()->route('user.dashboard');
    }

    public function show(Account $account): Factory|View|Application
    {
        $user = auth()->user();
        if (($account->user_id !== $user->id) && ! isset($user->family)) {
            abort(403, 'this is not your account, and you are not in a family');
        }
        if (isset($user->family) && ! $user->family->users->contains($account->user)) {
            abort(403, 'this is account is not from a family member');
        }

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
        $user = auth()->user();
        if ($account->user_id !== $user->id) {
            abort_unless($account->user->family->created_by === $user->id, 403);
        }

        $data = [
            'account' => $account,
            'types' => AccountType::all(),
        ];

        return view('accounts.edit', $data);
    }

    public function update(Request $request, Account $account): RedirectResponse
    {
        $user = auth()->user();
        if (($account->user_id !== $user->id) && ! isset($user->family)) {
            abort(403, 'this is not your account, and you are not in a family');
        }
        if (isset($user->family) && ! $user->family->users->contains($account->user)) {
            abort(403, 'this is account is not from a family member');
        }

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
