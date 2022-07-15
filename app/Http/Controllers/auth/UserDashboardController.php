<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserDashboardController extends Controller
{
    public function index(): Factory|View|Application
    {
        $data = ['user' => auth()->user()];
        return view('users.dashboard', $data);
    }
}
