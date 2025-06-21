<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            // 'post_id' => fake()->unique()->numberBetween(1,20),
            'user_id' => 1,
            'title' => fake()->text(25),
            'description' => fake()->paragraph(1),
            'content' => fake()->paragraph(10),
            'thumbnail' => 'no_photo.jpg',
            'is_deleted' => 0,
            'published_at' => fake()->date()
        ];
    }
}
