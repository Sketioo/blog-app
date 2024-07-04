<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (User::count() === 0) {
            $this->command->error('No users found. Run UserSeeder first.');
            return;
        }

        if (BlogPost::count() === 0) {
            $this->command->error('No blog posts found. Run BlogPostSeeder first.');
            return;
        }

        $commentCount = (int) $this->command->ask('How many comments do you want to create?', 150);

        Comment::factory()->count($commentCount)->create();
    }
}
