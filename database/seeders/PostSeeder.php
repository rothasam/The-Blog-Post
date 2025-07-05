<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Post::factory(12)
        //         ->has(Category::factory(3))
        //         ->create();

        Post::factory(12)
        ->create()
        ->each(function ($post) {
            $categoryIds = Category::inRandomOrder()->take(3)->pluck('category_id'); // or 'id' based on your PK
            $post->categories()->attach($categoryIds);
        });
    }
}
 