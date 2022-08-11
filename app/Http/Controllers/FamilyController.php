<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Family;
use App\Models\User;
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
            Account::findorfail((int)$account)->update(['family_id' => $family->id]);
        }

        return redirect()->route('user.dashboard');
    }

    public function edit(Family $family): View|Factory|Response|Application
    {
        //verify if user is allowed to edit the family
        if ((int)$family->head !== auth()->user()->id || $family->deleted_at !== null) {
            abort(404); //deny as not found
        }
        return view('family.edit', compact('family'));
    }

    public function update(Request $request, Family $family): RedirectResponse
    {
        //verify if user is allowed to edit the family
        if ((int)$family->head !== auth()->user()->id || $family->deleted_at !== null) {
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
            foreach ($request->users as $user) {
                $userId = (int)$user;
                if ($userId === (int)$family->head && count($family->users) > 1) {
                    return back()->withErrors('cant delete head of family if there are other members');
                }
                $this->removeAccountsFromFamilyOnLeave($userId);
            }
        }
        if (count($family->fresh()->users) === 0) {
            $family->delete();
        }

        return redirect()->route('user.dashboard');
    }

    private function removeAccountsFromFamilyOnLeave($userId)
    {
        Account::where('user_id', $userId)->update(['family_id' => null]);
        $userModel = User::findOrFail($userId)->family()->dissociate();
        $userModel->save();

    }

    public function leave(Family $family): RedirectResponse
    {
        //verify if user is allowed to leave the family
        if ((int)$family->head === auth()->user()->id || $family->deleted_at !== null) {
            abort(404); //deny as not found
        }

        $user = auth()->user();
        $this->removeAccountsFromFamilyOnLeave($user->id);
        $user->family()->dissociate();
        $user->save();

        return redirect()->route('user.dashboard');
    }

    public function show(): RedirectResponse
    {
        return redirect()->route('user.dashboard');
    }
}
