<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Family::factory(1)->create([
            'name' => 'demo family',
            'head' => 2,
        ]
        );
    }
}
