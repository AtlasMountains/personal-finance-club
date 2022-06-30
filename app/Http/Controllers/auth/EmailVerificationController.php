<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class EmailVerificationController extends Controller
{

    public function index(Request $request)
    {
        $key = 'verification_emails.' . $request->user()->id;
        $time = now();
        $time->addSeconds(RateLimiter::availableIn($key));
        return view('auth.verify-email', [
            'remaining' => RateLimiter::retriesLeft($key, 3),
            'wait_time' => $time->diffForHumans()
        ]);
    }

    public function send(Request $request)
    {
        $key = 'verification_emails.' . $request->user()->id;
        $request->user()->sendEmailVerificationNotification();
        RateLimiter::hit($key, 4 * 3600);
        return back()->with(['message' => 'email send']);
    }

    public function fulfill(EmailVerificationRequest $request)
    {
        $key = 'verification_emails.' . $request->user()->id;
        $request->fulfill();
        RateLimiter::clear($key);
        return redirect()->route('user.dashboard');
    }
}
