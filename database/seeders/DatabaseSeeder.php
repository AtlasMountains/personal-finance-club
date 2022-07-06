<?php

namespace Database\Seeders;

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
            FamilySeeder::class,
            AccountTypeSeeder::class,
            UserSeeder::class,
            AccountSeeder::class,
            TagSeeder::class,
            TypeSeeder::class,
            CategorySeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
