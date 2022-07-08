<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'housing', 'utilities', 'transportation',
            'food', 'clothing', 'healthcare', 'insurance',
            'household', 'personal', 'debt', 'retirement',
            'education', 'savings', 'gifts', 'entertainment',
        ];
        foreach ($categories as $category) {
            Category::create([
                'category' => $category,
            ]);
        }
    }
}
