<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
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
            'content' => implode("\n\n", array_map(function () {
                return $this->faker->paragraph(12);
            }, range(1, 6))),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
        ];
    }
}
