<?php

namespace App\Http\Livewire;

use App\Models\Family;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class Families extends Component
{
    use Actions;

    public ?Family $family;
    public ?string $email = null;

    protected $rules = [
        'email' => ['required', 'email'],
    ];

    public function mount(): void
    {
        $this->family = auth()->user()->family;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.families');
    }

    public function updated($email)
    {
        $this->validateOnly($email);
    }

    public function inviteMember()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        if ($user) {
//            send notification
        }

        $this->notification()->success(
            $title = 'Invite send',
            $description = 'an invite to join the family was send,
            if the user does not have an account please ask them to make an account first',
        );
    }

    public function cancel(): void
    {
        $this->notification()->warning(
            $title = 'Action canceled',
            $description = 'no invite was send'
        );
    }
}
