<?php

namespace Database\Seeders;

use App\Models\TransactionTag;
use Illuminate\Database\Seeder;

class TransactionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['bathroom', 'kitchen', 'christmas'];
        foreach ($tags as $tag) {
            TransactionTag::create([
                'tag' => $tag
            ]);
        }
    }
}
