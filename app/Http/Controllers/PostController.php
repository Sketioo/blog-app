<?php

namespace App\Http\Controllers;

use App\Events\PostDeleting;
use App\Http\Requests\StorePostRequest;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

    public function search(Request $request)
    {
        $term = strip_tags($request->term);
        // dd($term);
        if ($term) {
            $posts = BlogPost::search($term)->query(function ($query) {
                $query->with(['user', 'comments'])->withCount('comments');
            })->paginate(12);
        } else {
            $posts = BlogPost::with(['user', 'comments'])->withCount('comments')->paginate(12);
        }

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
        $post = BlogPost::with('comments', 'comments.user', 'comments.replies')->findOrFail($id);
        $post->loadCount('comments');
        $post['content'] = Str::markdown($post->content);
        $post['title'] = Str::markdown($post->title);

        // Ambil komentar yang dibuat oleh pengguna saat ini
        $userId = auth()->check() ? auth()->user()->id : null;
        $comments = $post->comments;

        $userComments = $comments->filter(function ($comment) use ($userId) {
            return $comment->user_id === $userId;
        });

        $otherComments = $comments->filter(function ($comment) use ($userId) {
            return $comment->user_id !== $userId;
        });

        // Gabungkan komentar pengguna di atas komentar lainnya
        $sortedComments = $userComments->concat($otherComments);

        return view('posts.show', [
            'post' => $post,
            'comments' => $sortedComments,
        ]);
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
        $data['title'] = strip_tags($data['title']);
        $data['content'] = strip_tags($data['content']);
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

    public function storeComment(Request $request, BlogPost $post)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'parent_comment_id' => 'exists:comments,id',
        ]);

        $validatedData['content'] = strip_tags($validatedData['content']);

        $validatedData['blog_post_id'] = $post->id;
        $validatedData['user_id'] = auth()->user()->id;

        Comment::create($validatedData);

        return redirect()->route('posts.show', ['post' => $post->id])
            ->with('status', 'Comment was added!');
    }

    public function updateComment(Request $request, BlogPost $post, Comment $comment)
    {

        Log::info('Update Comment Request:', $request->all());

        $this->validate($request, [
            'content' => 'required|string|max:255',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return response()->json(['success' => 'Comment updated successfully', 'content' => $comment->content]);
    }

    public function deleteComment(BlogPost $post, Comment $comment)
    {
        $comment->delete();

        return back()->with('status', 'Comment deleted successfully!');
    }

}
