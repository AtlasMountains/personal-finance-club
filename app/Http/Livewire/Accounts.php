<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Accounts extends Component
{
    public User $user;

    public $family;

    public function mount()
    {
        $this->user = auth()->user();
        $this->family = $this->user->family?->familyusersWithAccounts;
    }

    public function render()
    {
        return view('livewire.accounts');
    }
}
