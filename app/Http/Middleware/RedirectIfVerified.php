<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RedirectIfVerified
{
    /**
     * Handle an incoming request. if user has verified email redirect dashboard
     *
     * @param  Request  $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (auth()->user()->email_verified_at) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
