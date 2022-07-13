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

    public function mount(): void
    {
        $this->user = auth()->user();
//        $this->accounts = auth()->user()->accountsWithTypes()->orderBy('position', 'asc')->get();
    }

    public function deleteRequest($accountId): void
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

    public function cancelDelete(): void
    {
        $this->notification()->warning(
            $title = 'Action canceled',
            $description = 'the account was not deleted'
        );
    }

    public function deleteAccount($accountId): void
    {
        $account = Account::findOrFail($accountId);

        auth()->user()->accounts()
            ->where('position', '>', $account->position)
            ->update(['position' => \DB::RAW('position - 1')]);
        $account->transactions()->delete();
        $account->delete();
        $this->accounts = $this->accounts->except($accountId);
        $this->notification()->success(
            $title = 'Account:'.$account->name.' deleted',
            $description = 'Your account and all transactions belonging to this account are deleted'
        );
    }

    public function updateAccountOrder($accounts): void
    {
        foreach ($accounts as $account) {
            $this->accounts->find($account['value'])->update(['position' => $account['order']]);
        }
    }

    public function render()
    {
        $this->accounts = auth()->user()->accountsWithTypes()->orderBy('position', 'asc')->get();

        return view('livewire.accounts');
    }
}
