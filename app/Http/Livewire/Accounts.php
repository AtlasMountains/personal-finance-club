<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;

class Accounts extends Component
{
    use Actions;

    public User $user;

    public $accounts;

    public function mount()
    {
        $this->user = auth()->user();
        $this->accounts = auth()->user()->accountsWithTypes;
    }

    public function deleteRequest($accountId)
    {
        $account = Account::findOrFail($accountId);
        $this->dialog()->confirm([
            'title' => 'Delete account: '.$account->name.'?',
            'description' => 'deleting the account wil also delete all transactions belonging to this account',
            'acceptLabel' => 'Yes, delete it',
            'accept' => [
                'label' => 'Yes, delete everything',
                'method' => 'deleteAccount',
                'params' => $accountId,
            ],
            'reject' => [
                'label' => 'No, cancel',
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
        $account = Account::findOrFail($accountId);
        $account->delete();
        $this->accounts = $this->accounts->except($accountId);
        $this->notification()->success(
            $title = 'Account:'.$account->name.' deleted',
            $description = 'Your account and all transactions belonging to this account are deleted'
        );
    }

    public function render()
    {
        return view('livewire.accounts');
    }
}
