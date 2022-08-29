<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class UserLoginController extends Controller
{
    private int $maxAttempts = 3;

    public function index(Request $request): Factory|View|Application
    {
        $key = 'login.'.$request->ip();
        $remaining = RateLimiter::retriesLeft($key, $this->maxAttempts);
        $wait_time = now()->addSeconds(RateLimiter::availableIn($key))->diffForHumans();

        return view('auth.login', compact('remaining', 'wait_time'));
    }

    public function store(UserLoginRequest $request): RedirectResponse
    {
        $key = 'login.'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            return back()->withInput()->withErrors(['max_attempts' => trans('auth.attempts_max')]);
        }

        RateLimiter::hit($key);
        if (! auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->withInput()->withErrors(['status' => trans('auth.failed')]);
        }
        RateLimiter::resetAttempts($key);

        return redirect()->route('user.dashboard');
    }
}
