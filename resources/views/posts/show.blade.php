@extends('layouts.app')

@section('title', $post->title . ' - A Compelling Read')

@section('content')
    <div class="container my-5">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <img src="{{ asset('https://contenthub-static.grammarly.com/blog/wp-content/uploads/2022/08/BMD-3398.png') }}"
                alt="{{ $post->title }}" class="card-img-top">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text">{{ $post->content }}</p>
                <div class="card-footer d-flex justify-content-between">
                    <span class="text-muted">Created: {{ $post->created_at->format('F d, Y') }}</span>
                    @if ($post->updated_at != $post->created_at)
                        <span class="text-muted">Updated: {{ $post->updated_at->format('F d, Y') }}</span>
                    @endif
                </div>
            </div>

            <div class="card-body d-flex flex-column align-items-center py-4">
                <form action="{{ route('posts.comment', $post) }}" method="post" class="comment-form w-75 mb-3">
                    @csrf
                    <div class="form-floating mb-3">
                        <textarea name="content" id="comment" class="form-control" rows="5" placeholder="Leave a comment..."></textarea>
                        <label for="comment">Share your thoughts</label>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </form>
            </div>

            @if ($post->comments->count() > 0)
                <div class="card-body mt-3">
                    <h5>Comments</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item d-flex">
                                <img src="{{ asset('https://www.gravatar.com/avatar/0?s=40&d=mm') }}" alt="Commenter Avatar"
                                    class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                <div class="media-body flex-grow-1 bg-light rounded p-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                    @auth
                                        <a href="#" class="btn btn-sm btn-outline-primary">Reply</a>
                                    @endauth
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="card-body d-flex flex-column align-items-center py-4">
                    <p class="text-muted">No comments yet. Be the first to share your thoughts!</p>
                </div>
            @endif
        </div>
    </div>
@endsection
