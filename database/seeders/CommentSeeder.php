<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            User::factory()->count(15)->create();
        }

        if (BlogPost::count() == 0) {
            BlogPost::factory()->count(50)->create([
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }

        Comment::factory()->count(150)->create();
    }
}
