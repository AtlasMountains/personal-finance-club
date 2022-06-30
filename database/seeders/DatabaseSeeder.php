<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
            'email_verified_at' => now(),
            'is_admin' => true,
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);
//         make user email-not-verified
        User::factory()->create([
            'first_name' => 'user',
            'last_name' => 'not verified',
            'email' => 'user@not-verified.com',
            'email_verified_at' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
//        make user email-verified
        User::factory()->create([
            'first_name' => 'user',
            'last_name' => 'verified',
            'email' => 'user@verified.com',
            'email_verified_at' => now(),
            'is_admin' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
    }

}
