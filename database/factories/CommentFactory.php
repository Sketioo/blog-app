<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BlogPost;
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
            'content' => fake()->paragraph(),
            'blog_post_id' => function () {
                return BlogPost::inRandomOrder()->first()->id;
            },
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'parent_comment_id' => null
        ];
    }
}
