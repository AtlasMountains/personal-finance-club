<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
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
            Tag::create([
                'tag' => $tag,
            ]);
        }
    }
}
