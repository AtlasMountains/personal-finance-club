<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function index()
    {
        return view('auth.verify-email');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function fulfill(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('user.dashboard');
    }
}
