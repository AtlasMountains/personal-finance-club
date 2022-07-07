<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        $data = ['user' => auth()->user()];
        return view('users.dashboard', $data);
    }
}
