<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory(50)->create();
        $tags = Tag::all();
        foreach ($tags as $tag) {
            DB::table('tag_user')->insert([
                'tag_id' => $tags->random()->id,
                'user_id' => User::all()->random()->id
            ]);
        }
    }
}
