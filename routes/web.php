<?php

use App\Http\Controllers\UserRegisterController;
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
Route::view('/blog', 'blog')->name('blog');

Route::group(['middleware' => 'guest'], function () {

Route::view('/login', 'auth.login')->name('login');
Route::get('/register', [UserRegisterController::class, 'index'])->name('register');
});
