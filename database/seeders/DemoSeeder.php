<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Family;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // restore family
        $family = Family::withTrashed()->find(1);
        $family->update([
            'name' => 'demo family',
            'head' => 2,
            'deleted_at' => null,
        ]);
        $family->save();

        // restore users
        $member = User::withTrashed()->find(1);
        $member->update([
            'first_name' => 'demo',
            'last_name' => 'member',
            'family_id' => 1,
            'email' => 'member@family.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'deleted_at' => null,
        ]);
        $member->save();

        $head = User::withTrashed()->find(2);
        $head->update([
            'first_name' => 'demo',
            'last_name' => 'head',
            'family_id' => 1,
            'email' => 'head@family.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'deleted_at' => null,
        ]);
        $head->save();

        $this->deleteAccountsAndTransactions($member);
        $this->deleteAccountsAndTransactions($head);
        $this->createAccountsAndTransactions($member, $family);
        $this->createAccountsAndTransactions($head, $family);
    }

    private function deleteAccountsAndTransactions(User $user)
    {
        // delete all accounts and transactions for member
        foreach (Account::withTrashed()->where('user_id', $user->id)->get() as $account) {
            $transaction = Transaction::withTrashed()->where('account_id', $account->id);
            $transaction->delete();
            $transaction->forceDelete();
            $account->delete();
            $account->forceDelete();
        }
    }

    private function createAccountsAndTransactions(User $user, Family $family)
    {
        // make new accounts and transactions
        Account::factory(random_int(2, 3))->create([
            'user_id' => $user->id,
            'family_id' => $family->id,
        ]);
        foreach ($user->accounts as $account) {
            Transaction::factory(random_int(100, 500))->create([
                'account_id' => $account->id,
            ]);
        }
    }
}
