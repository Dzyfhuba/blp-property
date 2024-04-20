<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(50),
            'slug' => $this->faker->slug(5),
            'description' => $this->faker->text(),
            'content' => $this->faker->text(),
            // 'tags' => $this->faker->words(),
            'thumbnail' => $this->faker->imageUrl(),
            'user_id' => 1,
        ];
    }

    // public function configure()
    // {
    //     return $this->afterCreating(function (Blog $blog) {
    //         $blog->update(['user_id' => \App\Models\User::factory()->create()->id]);
    //     });
    // }

}
