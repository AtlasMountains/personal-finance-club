<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        //TODO  dashboard
        return redirect()->route('user.account.index');
    }
}
