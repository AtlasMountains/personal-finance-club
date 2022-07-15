<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class EmailVerificationController extends Controller
{
    private int $maxAttempts = 3;

    public function index(Request $request): Factory|View|Application
    {
        $key = 'verification_emails.' . $request->user()->id;
        $wait_time = now()->addSeconds(RateLimiter::availableIn($key))->diffForHumans();
        $remaining = RateLimiter::retriesLeft($key, $this->maxAttempts);

        return view('auth.verify-email', compact('remaining', 'wait_time'));
    }

    public function send(Request $request): RedirectResponse
    {
        $key = 'verification_emails.' . $request->user()->id;
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            return back()->withErrors(['max_attempts' => __('auth.attempts_max')]);
        }
        $request->user()->sendEmailVerificationNotification();
        RateLimiter::hit($key, 3600);

        return back()->with(['message' => 'email send']);
    }

    public function fulfill(EmailVerificationRequest $request): RedirectResponse
    {
        $key = 'verification_emails.' . $request->user()->id;
        $request->fulfill();
        RateLimiter::clear($key);

        return redirect()->route('user.dashboard');
    }
}
