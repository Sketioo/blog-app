<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $model = BlogPost::class;
    public function run(): void
    {

        if(User::count() == 0) {
            User::factory()->count(15)->create();
        }

        BlogPost::factory()->count(50)->create();
    }
}
