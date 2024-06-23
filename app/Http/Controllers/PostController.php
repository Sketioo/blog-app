<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        1 => [
            'title' => 'post 1',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aperiam?',
            'is_new' => true,
            'has_comment' => 'This post has a comment',
        ],
        2 => [
            'title' => 'post 2',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, aperiam?',
            'is_new' => false,
        ],
    ];

    public function index()
    {
        return view('posts.index', ['posts' => $this->posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!isset($this->posts[$id]), 404);

        return view('posts.show', ['post' => $this->posts[$id]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
