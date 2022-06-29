<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(UserCreateRequest $request)
    {
//        validate in UserCreateRequest class
//        store in db
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
//        send verification email
        event(new Registered($user));
//        login
        auth()->attempt($request->only('email','password'));
//        redirect
        return redirect()->route('home');
    }
}
