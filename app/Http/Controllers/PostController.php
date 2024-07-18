<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\BlogPost;
use App\Events\PostDeleting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

// use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    public function index()
    {
        $posts = BlogPost::with(['user', 'comments'])->withCount('comments')->paginate(12);
        return view('posts.index', ['posts' => $posts]);
    }

    // public function search($term)
    // {
    //     $posts = BlogPost::search($term)->get();
    //     return response()->json($posts);
    // }

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

        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        BlogPost::create($validatedData);
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
        $this->authorize('update', $post);
        $post = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize('update', $post);

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
        $post = BlogPost::findOrFail($id);

        $this->authorize('delete', $post);

        event(new PostDeleting($post));

        $post->delete();

        return redirect()
            ->route('user.posts')
            ->with('status', 'Blog was deleted!');

        abort(403, 'Cannot delete this post!');
    }

    public function storeComment(Request $request,  BlogPost $post) {

        $validatedData = $request->validate([
            'content' => 'required|max:255'
        ]);

        $validatedData['blog_post_id'] = $post->id;
        $validatedData['user_id'] = auth()->user()->id;

        // $post->comments()->create($validatedData);
        Comment::create($validatedData);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

}
