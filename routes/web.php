<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\auth\EmailVerificationController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\UserDashboardController;
use App\Http\Controllers\auth\UserLoginController;
use App\Http\Controllers\auth\UserPasswordResetController;
use App\Http\Controllers\auth\UserRegisterController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/account', [AccountController::class, 'index'])->name('account');

//only for guests if auth redirect home
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserLoginController::class, 'index'])->name('login');
    Route::post('/login', [UserLoginController::class, 'store'])->middleware('throttle:login');

    Route::get('/register', [UserRegisterController::class, 'index'])->name('register');
    Route::post('/register', [UserRegisterController::class, 'store'])->middleware('throttle:register');
});

// email verification only for auth, redirect login & if already verified redirect dashboard
Route::group(['middleware' => ['auth', 'if_verified_redirect'], 'as' => 'verification.'], function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'index'])
        ->name('notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'fulfill'])
        ->middleware('signed')
        ->name('verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->name('send');
});

// password reset
Route::group(['middleware' => ['guest']], function () {
    Route::get('/forgot-password', [UserPasswordResetController::class, 'index'])
        ->name('password.request');
    Route::post('/forgot-password', [UserPasswordResetController::class, 'sendEmail']);

    Route::get('/reset-password/{token}', [UserPasswordResetController::class, 'resetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [UserPasswordResetController::class, 'resetPassword'])
        ->name('password.update');
});

// only for logged-in users
Route::group(['middleware' => 'auth', 'as' => 'user.'], function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'verified'], function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('account', AccountController::class)
            ->except(['index', 'destroy']);

        Route::resource('family', FamilyController::class)
            ->except('index');
    });
});
