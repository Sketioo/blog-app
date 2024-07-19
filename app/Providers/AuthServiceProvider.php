<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Comment;
use App\Models\BlogPost;
use App\Policies\CommentPolicy;
use App\Policies\BlogPostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // 'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy'
        BlogPost::class => BlogPostPolicy::class,
        Comment::class => CommentPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::define('update-post', function (User $user,BlogPost $post) {
        //     return $user->id === $post->user_id;
        // });

        // Gate::define('delete-post', function (User $user,BlogPost $post) {
        //     return $user->id === $post->user_id;
        // });

        // Gate::define('delete-post', [BlogPostPolicy::class, 'delete']);
        // Gate::define('update-post', [BlogPostPolicy::class, 'update']);

        // Gate::resource('posts', BlogPostPolicy::class);

        Gate::before(function(User $user, string $ability){
            if($user->is_admin && in_array($ability, ['posts.delete', 'posts.update'])) {
                return true;
            }
        });
        

        // Gate::before(function(User $user, string $ability){
        //     if($user->is_admin) {
        //         return true;
        //     }
        // });
    }
}
