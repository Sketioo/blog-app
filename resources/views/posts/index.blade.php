<!-- index.blade.php -->
@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="container my-5">
        @include('posts.partials.search')
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if ($posts->isEmpty())
            <div class="alert alert-info" role="alert">
                There are currently no posts available.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($posts as $post)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <img src="{{ asset('https://contenthub-static.grammarly.com/blog/wp-content/uploads/2022/08/BMD-3398.png') }}"
                                alt="{{ $post->title }}" class="card-img-top" style="object-fit: cover; height: 200px;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="text-end">
                                    <span class="badge bg-primary text-white my-1">Comments: {{ $post->comments_count }}</span>
                                </div>
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                                    class="btn btn-primary mt-auto">Read
                                    More</a>
                                <div class="mt-3">
                                    <small class="text-muted">Posted by {{ $post->user->name }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 d-flex justify-content-center mt-4">
                {{ $posts->links('posts.partials.pagination') }} <!-- Pagination links -->
            </div>
        @endif
    </div>
@endsection
