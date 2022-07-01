<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class UserLoginController extends Controller
{
    public function index(Request $request)
    {
        $key = 'login.' . $request->ip();
        $remaining = RateLimiter::retriesLeft($key, 3);
        $wait_time = RateLimiter::availableIn($key);
        return view('auth.login', compact('remaining', 'wait_time'));
    }

    public function store(UserLoginRequest $request): RedirectResponse
    {
        $key = 'login.' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->with('max_attempts', __('auth.attempts_max'));
        }
        RateLimiter::hit($key);
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with([
                'status' => __('auth.failed'),
                'email' => $request->email,
            ]);
        }
        return redirect()->route('user.dashboard');
    }
}
