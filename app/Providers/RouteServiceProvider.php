<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

//        rate limiter for login, all users combined
        RateLimiter::for('login', function () {
            return Limit::perMinute(5000);
        });

//        rate limiter for register, all users combined
        RateLimiter::for('register', function () {
            return Limit::perMinute(5000);
        });

        ////      rate limiter for verification emails by user
//        RateLimiter::for('verification_emails', function (Request $request) {
//            return Limit::perHour(3, 4)
//                ->by('verification_emails.' . $request->user()->id)
//                ->response(function () {
//                    return back()->with('max_attempts', __('auth.attempts_max'));
//                });
//        });
//
////      rate limiter for login by ip
//        RateLimiter::for('login', function (Request $request) {
//            return Limit::perMinute(3)
//                ->by('login.' . $request->ip())
//                ->response(function () {
//                    return back()->with('max_attempts', __('auth.attempts_max'));
//                });
//        });
//
//        //rate limiter for registration by ip
//        RateLimiter::for('register', function (Request $request) {
//            return Limit::perHour(3, 3)
//                ->by('register.' . $request->ip())
//                ->response(function () {
//                    return back()->with('max_attempts', __('auth.attempts_max'));
//                });
//        });
    }
}
