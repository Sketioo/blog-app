<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BlogPost::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => implode("\n\n", $this->faker->paragraphs(6)),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
        ];
    }
}
