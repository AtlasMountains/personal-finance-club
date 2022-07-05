<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

//         make admin user
        User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'administrator',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

//         make user email-not-verified
        User::factory()->create([
            'first_name' => 'user',
            'last_name' => 'not verified',
            'email' => 'user@not-verified.com',
            'email_verified_at' => null,
        ]);

//        make user email-verified
        User::factory()->create([
            'first_name' => 'user',
            'last_name' => 'verified',
            'email' => 'user@verified.com',
        ]);
    }
}
