<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class UserRegisterController extends Controller
{
    public function index(Request $request)
    {
        $key = 'register.'.$request->ip();
        $remaining = RateLimiter::retriesLeft($key, 3);
        $wait_time = now()->addSeconds(RateLimiter::availableIn($key))->diffForHumans();

        return view('auth.register', compact('remaining', 'wait_time'));
    }

    public function store(UserCreateRequest $request)
    {
        $key = 'register.'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['max_attempts' => trans('auth.attempts_max')]);
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
//        send email
        event(new Registered($user));
//        limit registrations by ip decay per 3 hours
        RateLimiter::hit($key, 3 * 3600);
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('user.dashboard');
    }
}
