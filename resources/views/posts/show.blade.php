@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container my-5">
        @if ($post->is_new)
            <div class="alert alert-info" role="alert">
                This is a new post
            </div>
        @else
            <div class="alert alert-secondary" role="alert">
                This is an old post
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-text">{{ $post->content }}</p>

                @isset($post->has_comment)
                    <div class="alert alert-warning" role="alert">
                        This post has a comment
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
