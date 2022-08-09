<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Family;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index(): view
    {
        $accounts = auth()->user()->family->accountsWithTypes;
        return view('family.index', compact('accounts'));
    }

    public function create(): Factory|View|Application
    {
        $accounts = auth()->user()->accounts;

        return view('family.create', compact('accounts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'unique:families'],
        ]);

        $family = Family::create([
            'name' => $request->name,
            'head' => auth()->user()->id,
        ]);

        auth()->user()->family()->associate($family);
        auth()->user()->save();

        foreach ($request->accounts as $account) {
            Account::findorfail($account)->update(['family_id' => $family->id]);
        }

        return redirect()->route('user.dashboard');
    }

    public function edit(Family $family): Factory|View|Application
    {
//        $user = auth()->user();
//        if ($account->user_id !== $user->id) {
//            abort_unless($account->user->family->created_by === $user->id, 403);
//        }
//
//        $data = [
//            'account' => $account,
//            'types' => AccountType::all(),
//        ];
//
//        return view('accounts.edit', $data);
    }

    public function update(Request $request, Family $family): RedirectResponse
    {
//        $user = auth()->user();
//        if (($account->user_id !== $user->id) && !isset($user->family)) {
//            abort(403, 'this is not your account, and you are not in a family');
//        }
//        if (isset($user->family) && !$user->family->users->contains($account->user)) {
//            abort(403, 'this is account is not from a family member');
//        }
//
//        $this->validate($request, [
//            'name' => ['required'],
//            'balance' => ['nullable', 'numeric'],
//            'alert' => ['nullable', 'numeric'],
//            'type' => 'required',
//        ]);
//
//        $account->update([
//            'name' => $request->name,
//            'slug' => SlugService::createSlug(Account::class, 'slug', $request->name),
//            'account_type_id' => $request->type,
//            'alert' => (int)($request->alert * 100),
//        ]);
//
//        return redirect()->route('user.dashboard');
    }
}
