@extends('layouts.app')

@section('title', $post->title . ' - A Compelling Read')

@section('content')
    <div class="container my-5 d-flex flex-column align-items-center">
        <div class="card shadow-sm" style="width: 36rem;">
            <img src="{{ asset('https://contenthub-static.grammarly.com/blog/wp-content/uploads/2022/08/BMD-3398.png') }}"
                alt="{{ $post->title }}" class="card-img-top">
            <div class="card-body">
                <h2 class="card-title ">{{ $post->title }}</h2>
                <p class="card-text">{{ $post->content }}</p>
                <div class="card-footer d-flex justify-content-between">
                    <span class="text-muted">Created: {{ Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</span>
                    @if ($post->updated_at !== $post->created_at)
                        <span class="text-muted">Updated:
                            {{ Carbon\Carbon::parse($post->updated_at)->format('F d, Y') }}</span>
                    @endif
                </div>
            </div>

            @if ($post->comments->count() > 0)
                <div class="card-body mt-3">
                    <h5>Comments</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item d-flex">
                                <img src="{{ asset('https://www.gravatar.com/avatar/0?s=40&d=mm') }}" alt="Commenter Avatar"
                                    class="rounded-circle mr-3" style="width: 40px; height: 40px;">
                                <div class="media-body flex-grow-1 bg-light rounded p-2 mx-2">
                                    <p>{{ $comment->content }}</p>
                                    @auth
                                        <a href="#" class="btn btn-sm btn-outline-primary">Reply</a>
                                    @endauth
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
