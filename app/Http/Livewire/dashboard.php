<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class dashboard extends Component
{
    public $firstName;

    public $lastName;

    public $email;

    public function mount()
    {
        $this->firstName = auth()->user()->first_name;
        $this->lastName = auth()->user()->last_name;
        $this->email = auth()->user()->email;
    }

    public function updatedfirstName()
    {
        User::where('id', '=', auth()->user()->id)->update([
            'first_name' => $this->firstName,
        ]);
    }

    public function updatedlastName()
    {
        User::where('id', '=', auth()->user()->id)->update([
            'last_name' => $this->lastName,
        ]);
    }

    public function updatedemail()
    {
        User::where('id', '=', auth()->user()->id)->update([
            'email' => $this->email,
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
