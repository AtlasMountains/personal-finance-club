<?php

use App\Http\Controllers\auth\EmailVerificationController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\UserDashboardController;
use App\Http\Controllers\auth\UserLoginController;
use App\Http\Controllers\auth\UserRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home')->name('home');

//only for guests
Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', [UserLoginController::class, 'index'])->name('login');
    Route::post('/login', [UserLoginController::class, 'store']);

    Route::get('/register', [UserRegisterController::class, 'index'])->name('register');
    Route::post('/register', [UserRegisterController::class, 'store']);
});

// email verification
Route::group(['middleware' => ['auth', 'if_verified_redirect'], 'as' => 'verification.'], function () {

    Route::get('/email/verify', [EmailVerificationController::class, 'index'])
        ->name('notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'fulfill'])
        ->middleware('signed')
        ->name('verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware('throttle:verification_emails')
        ->name('send');
});


// only for logged-in users
Route::group(['middleware' => 'auth', 'as' => 'user.'], function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
