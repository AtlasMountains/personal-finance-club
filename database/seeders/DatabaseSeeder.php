<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            FamilySeeder::class,
            AccountTypeSeeder::class,
            AccountSeeder::class,
            TagSeeder::class,
            TypeSeeder::class,
            CategorySeeder::class,
            TransactionSeeder::class,
        ]);

        $head = User::where('email', 'head@family.com')->first();
        $member = User::where('email', 'member@family.com')->first();
        $family = Family::where('name', 'demo family')->first();

        $head->family()->associate($family);
        $head->save();
        foreach ($head->accounts as $account) {
            $account->family()->associate($family);
            $account->save();
        }

        $member->family()->associate($family);
        $member->save();
        foreach ($member->accounts as $account) {
            $account->family()->associate($family);
            $account->save();
        }
    }
}
