<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostCategory>
 */
class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // counting existing record
        $countPost = Post::query()->count();
        $countCategory = Category::query()->count();

        if($countPost!==0 && $countCategory!==0){
            $postId = rand(1,$countPost);
            $cateId = rand(1,$countCategory);
        }

        return [
            // 'post_id' => $postId,
            'category_id' => $cateId
        ];
    }
}
