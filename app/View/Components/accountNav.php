<?php

namespace App\View\Components;

use App\Models\Family;
use App\Models\User;
use Illuminate\View\Component;

class accountNav extends Component
{
    public User $user;
    public Family $family;
    public $familyUsersWithAccounts;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->family = $this->user->family;
        $this->familyUsersWithAccounts = $this->family->usersWithAccounts();
    }

    public function render()
    {
        return view('components.accountNav');
    }
}
