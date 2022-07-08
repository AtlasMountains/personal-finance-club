<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;

class Profile extends Component
{
    use Actions;

    public $firstName;

    public $lastName;

    public $email;

    protected $rules = [
        'firstName' => 'required|alpha|max:125',
        'lastName' => 'required|alpha|max:125',
        'email' => 'required|email|max:125|unique:users',
    ];

    public function mount()
    {
        $this->firstName = auth()->user()->first_name;
        $this->lastName = auth()->user()->last_name;
        $this->email = auth()->user()->email;
    }

    public function updatedfirstName()
    {
        $this->validateOnly('firstName');
        User::where('id', '=', auth()->user()->id)->update([
            'first_name' => $this->firstName,
        ]);

        $this->notification()->success(
            $title = 'First Name saved',
            $description = 'Your profile was successfully saved'
        );
    }

    public function updatedlastName()
    {
        $this->validateOnly('lastName');
        User::where('id', '=', auth()->user()->id)->update([
            'last_name' => $this->lastName,
        ]);

        $this->notification()->success(
            $title = 'Last Name saved',
            $description = 'Your profile was successfully saved'
        );
    }

    public function updatedemail()
    {
        $this->notification()->confirm([
            'title' => 'Are you Sure?',
            'description' => 'Save the information?',
            'icon' => 'question',
            'accept' => [
                'label' => 'Yes, save it',
                'method' => 'saveEmail',
            ],
            'reject' => [
                'label' => 'No, cancel',
                'method' => 'resetData',
            ],
            'onTimeout' => [
                'method' => 'resetData',
            ],
        ]);
    }

    public function saveEmail()
    {
        $this->validateOnly('email');

        User::where('id', '=', auth()->user()->id)->update([
            'email' => $this->email,
        ]);

        $this->notification()->success(
            $title = 'Email saved',
            $description = 'Your profile was successfully saved',
        );
    }

    public function resetData()
    {
        $this->firstName = auth()->user()->first_name;
        $this->lastName = auth()->user()->last_name;
        $this->email = auth()->user()->email;
        $this->notification()->error(
            $title = 'Not Saved',
            $description = 'Your profile was reset',
        );
    }

    public function render()
    {
        return view('livewire.Profile');
    }
}
