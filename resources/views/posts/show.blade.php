@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container my-5 d-flex flex-column align-items-center">
        @if ($post->is_new)
            <span class="badge bg-primary text-white mb-3">New Post</span>
        @else
            <span class="badge bg-secondary text-white mb-3">Old Post</span>
        @endif

        <div class="card shadow-sm" style="width: 36rem;">
            <img src="{{ asset('https://contenthub-static.grammarly.com/blog/wp-content/uploads/2022/08/BMD-3398.png') }}"
                alt="{{ $post->title }}" class="card-img-top">
            <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>
                <p class="card-text">{{ $post->content }}</p>
            </div>
            @isset($post->has_comment)
                <div class="card-footer bg-warning text-white">This post has a comment</div>
            @endisset
        </div>
    </div>
@endsection
