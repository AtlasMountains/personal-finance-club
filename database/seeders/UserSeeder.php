<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        make user member of a family
        User::factory()->create([
            'first_name' => 'demo',
            'last_name' => 'member',
            'email' => 'member@family.com',
        ]);

//        make user head of a family
        User::factory()->create([
            'first_name' => 'demo',
            'last_name' => 'head',
            'email' => 'head@family.com',
        ]);
    }
}
