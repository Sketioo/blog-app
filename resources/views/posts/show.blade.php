@extends('layouts.app')

@section('title', $post->title . ' - A Compelling Read')

@section('content')
    <div class="container my-5 justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <img src="{{ asset('https://contenthub-static.grammarly.com/blog/wp-content/uploads/2022/08/BMD-3398.png') }}"
                alt="{{ $post->title }}" class="card-img-top">
            <div class="card-body">
                <h2 class="card-title">{!! $post->title !!}</h2>
                <p class="card-text">{!! $post->content !!}</p>
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

            @if ($comments->count() > 0)
                <div class="card-body mt-3">
                    <h5>Comments</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($comments as $comment)
                            <li class="list-group-item">
                                <div class="d-flex">
                                    <img src="{{ asset('https://www.gravatar.com/avatar/0?s=40&d=mm') }}"
                                        alt="Commenter Avatar" class="rounded-circle me-3"
                                        style="width: 40px; height: 40px;">
                                    <div class="media-body flex-grow-1 bg-light rounded p-2"
                                        id="comment-{{ $comment->id }}">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong>{{ $comment->user->name }}</strong>
                                            <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="comment-content"
                                            @if (auth()->check() && auth()->user()->id == $comment->user_id) onclick="toggleEditForm({{ $comment->id }}, '{{ $comment->content }}')" class="editable" @endif>
                                            {{ $comment->content }}
                                        </p>
                                        @auth
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="" class="btn btn-sm btn-outline-primary reply-btn"
                                                    onclick="toggleReplyForm({{ $comment->id }})">Reply</a>
                                                @if (auth()->user()->id == $comment->user_id)
                                                    <form action="{{ route('posts.comment.destroy', [$post, $comment]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                            <!-- Form Reply untuk Komentar Utama -->
                                            <div class="reply-form mt-2" id="reply-form-{{ $comment->id }}"
                                                style="display: none;">
                                                <form action="{{ route('posts.comment', $post) }}" method="post"
                                                    class="comment-form">
                                                    @csrf
                                                    <div class="form-floating mb-3">
                                                        <textarea name="content" id="comment-{{ $comment->id }}" class="form-control" rows="3"
                                                            placeholder="Reply to comment..."></textarea>
                                                        <label for="comment-{{ $comment->id }}">Reply</label>
                                                        <input type="hidden" name="parent_comment_id"
                                                            value="{{ $comment->id }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                                </form>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                                <!-- Include replies -->
                                @include('posts.partials.comment-replies', [
                                    'replies' => $comment->replies,
                                ])
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
