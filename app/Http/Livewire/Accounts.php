<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use WireUi\Traits\Actions;

class Accounts extends Component
{
    use Actions;

    public User $user;
    public Collection $accounts;

    public function mount()
    {
        $this->user = auth()->user();
        $this->accounts = auth()->user()->accounts;
    }

    public function deleteRequest($accountId)
    {
        $name = Account::findOrFail($accountId)->name;
        $this->dialog()->confirm([
            'title' => 'Delete account: ' . $name . '?',
            'description' => 'deleting the account wil also delete all transactions belonging to this account',
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'save',
            'params'      => 'Saved',
        ]);
        $this->notification()->confirm([
            'title' => 'Delete account:' . $name . '?',
            'description' => 'deleting the account wil also delete all transactions belonging to this account',
            'icon' => 'question',
            'accept' => [
                'label' => 'Yes, delete everything',
                'method' => 'deleteAccount',
                'params' => $accountId,
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => 'cancelDelete',
            ],
        ]);
    }

    public function cancelDelete()
    {
        $this->notification()->warning(
            $title = 'Action canceled',
            $description = 'the account was not deleted'
        );
    }

    public function deleteAccount($accountId)
    {
        Account::findOrFail($accountId)->delete();
        $this->notification()->success(
            $title = 'Account deleted',
            $description = 'Your profile was successfully deleted'
        );
    }

    public function render()
    {
        return view('livewire.accounts');
    }
}
