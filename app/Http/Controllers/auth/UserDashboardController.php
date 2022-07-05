<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        $family = auth()->user()->family;
        $data = [
            'family' => $family,
            'familyAccounts' => $family->accounts,
            'userAccounts' => auth()->user()->accounts,
        ];
        return view('user.dashboard', $data);
    }
}
