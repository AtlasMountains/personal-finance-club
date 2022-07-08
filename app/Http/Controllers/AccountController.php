<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $data = [];

        return view('accounts.index', $data);
    }

    public function create()
    {
        $family = auth()->user()->family;
        $data = [
            'family' => $family,
            'familyAccounts' => $family->accounts,
            'userAccounts' => auth()->user()->accounts,
            'types' => AccountType::all(),
        ];

        return view('accounts.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:accounts'],
            'balance' => ['nullable', 'numeric'],
            'alert' => ['nullable', 'numeric'],
            'type' => 'required',
        ]);

        Account::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'account_type_id' => $request->type,
            'start_balance' => (int) ($request->balance * 100),
            'alert' => (int) ($request->alert * 100),
        ]);
    }

    public function show(Account $account)
    {
        $user = auth()->user();
        $data = [
            'family' => $user->family,
            'familyAccounts' => $user->family->accounts,
            'userAccounts' => $user->accounts,
            'types' => AccountType::all(),
            'account' => $account,
        ];

        return view('accounts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
