<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;

// use Illuminate\Http\Request;

class PostController extends Controller
{

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

        $posts = BlogPost::withCount('comments')->get();
        return view('posts.index', ['posts' => $posts]);
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

        BlogPost::create($data);

        return redirect()
            ->route('posts.index')
            ->with('status', 'Blog post was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        return view('posts.show', ['post' => BlogPost::with('comments')->findOrFail($id)]);
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
        $post = BlogPost::findOrFail($id);
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
        $post->delete();
        return redirect()
            ->route('posts.index')
            ->with('status', 'Blog was deleted!');
    }
}
