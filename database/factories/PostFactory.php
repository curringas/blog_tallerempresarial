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
     * 
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'content' => fake()->text(1000),
            'category_id' => fake()->numberBetween(1, 3),
            'published_at' => fake()->dateTime(),
        ];
    }
}
