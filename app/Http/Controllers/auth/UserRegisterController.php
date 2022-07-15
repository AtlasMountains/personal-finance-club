<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class UserRegisterController extends Controller
{
    private int $maxAttempts = 3;

    public function index(Request $request): Factory|View|Application
    {
        $key = 'register.' . $request->ip();
        $remaining = RateLimiter::retriesLeft($key, $this->maxAttempts);
        $wait_time = now()->addSeconds(RateLimiter::availableIn($key))->diffForHumans();

        return view('auth.register', compact('remaining', 'wait_time'));
    }

    public function store(UserCreateRequest $request): RedirectResponse
    {
        $key = 'register.' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
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
        RateLimiter::hit($key, $this->maxAttempts * 3600);
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('user.dashboard');
    }
}
