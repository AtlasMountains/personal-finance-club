<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['deposit', 'withdrawal', 'transfer'];
        foreach ($types as $type) {
            TransactionType::create([
                'type' => $type
            ]);
        }
    }
}
