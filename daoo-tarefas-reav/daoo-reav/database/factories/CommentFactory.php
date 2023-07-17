<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            "text" => fake()->text(20),
            "likes" => fake()->randomNumber(2, false),
            "dislikes" => fake()->randomNumber(2, false),
            "edited" => fake()->boolean(1, 0),
        ];
    }
}
