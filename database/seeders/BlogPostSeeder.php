<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $model = BlogPost::class;

    public function run(): void
    {
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }

        $count = $this->command->ask('How many blog posts do you want to create?', 50);

        BlogPost::factory()->count($count)->create();
    }
}
