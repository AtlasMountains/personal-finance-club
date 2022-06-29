<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
