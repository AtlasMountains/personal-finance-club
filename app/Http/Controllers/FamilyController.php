<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Family;
use Illuminate\Auth\Access\Response;
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
            'name' => ['required'],
        ]);

        $family = Family::create([
            'name' => $request->name,
            'head' => auth()->user()->id,
        ]);

        auth()->user()->family()->associate($family);
        auth()->user()->save();
        foreach ($request->accounts as $account) {
            Account::findorfail((int) $account)->update(['family_id' => $family->id]);
        }

        return redirect()->route('user.dashboard');
    }

    public function edit(Family $family): View|Factory|Response|Application
    {
        //verify if user is allowed to edit the family
        if ((int) $family->head !== auth()->user()->id) {
            abort(404); //deny as not found
        }

        return view('family.edit', compact('family'));
    }

    public function update(Request $request, Family $family): RedirectResponse
    {
        //verify if user is allowed to edit the family
        if ((int) $family->head !== auth()->user()->id) {
            abort(404); //deny as not found
        }

        $this->validate($request, [
            'name' => ['required', 'max:125'],
            'users' => ['nullable'],
        ]);

        $family->update([
            'name' => $request->name,
        ]);

        if ($request->users) {
            foreach ($users as $user) {
                Account::where('user_id', $user->id)->update(['family' => null]);
            }
        }

        return redirect()->route('user.dashboard');
    }

    public function show(): RedirectResponse
    {
        return redirect()->route('user.dashboard');
    }
}
