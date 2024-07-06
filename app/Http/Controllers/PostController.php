<?php

namespace App\Http\Controllers;

use App\Events\PostDeleting;
use App\Http\Requests\StorePostRequest;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        // DB::connection()->enableQueryLog();
        // $posts = BlogPost::with('comments')->get();

        // foreach ($posts as $post) {
        //     foreach ($post->comments as $comment) {
        //         echo $comment->content;
        //     }
        // }
        // dd(DB::getQueryLog());

        $posts = BlogPost::with(['user', 'comments'])->withCount('comments')->paginate(12);
        return view('posts.index', ['posts' => $posts]);
    }

    public function userPosts()
    {
        $user = auth()->user();

        $posts = BlogPost::where('user_id', $user->id)
            ->withCount('comments')
            ->paginate(6);

        return view('posts.user-posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $data = $request->validated();
        $user = auth()->user();
        $post = BlogPost::make($data);
        $post->user_id = $user->id;
        $post->save();
        return redirect()
            ->route('posts.index')
            ->with('status', 'Blog post was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = BlogPost::with('comments')->findOrFail($id);
        $post->load(['comments.user']);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        $user = auth()->user();
        $post = BlogPost::findOrFail($id);
        // if (Gate::forUser($user)->denies('update-post', $post)) {
        //     abort(403, 'Cannot edit this post!');
        // }
        $this->authorize('update-post', $post);
        $data = $request->validated();
        $post->update($data);
        return redirect()->route('posts.show', $id)
            ->with('status', 'Blog was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $post = BlogPost::findOrFail($id);
        // if (Gate::forUser($user)->denies('update-post', $post)) {
        //     abort(403, 'Cannot delete this post!');
        // }
        $this->authorize('delete-post', $post);
        $post = BlogPost::findOrFail($id);

        if ($user->id === $post->user_id) {
            event(new PostDeleting($post));

            $post->delete();

            return redirect()
                ->route('user.posts')
                ->with('status', 'Blog was deleted!');
        }

        abort(403, 'Cannot delete this post!');
    }

}
