<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(UserLoginRequest $request)
    {
       if(!auth()->attempt($request->only('email','password'))){
           return back()->with('status',__('auth.failed'));
       }
       return redirect()->route('user.dashboard');
    }
}
