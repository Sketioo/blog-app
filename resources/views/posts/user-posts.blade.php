@extends('layouts.app')

@section('title', 'My Posts')

@section('content')
    <div class="container my-5">
        @include('posts.partials.search')
        @if ($posts->isEmpty())
            <div class="alert alert-info" role="alert">
                You haven't created any posts yet.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($posts as $post)
                    <div class="col mb-4">
                        <div class="card shadow-sm h-100">
                            <img src="{{ asset('https://contenthub-static.grammarly.com/blog/wp-content/uploads/2022/08/BMD-3398.png') }}"
                                alt="{{ $post->title }}" class="card-img-top" style="object-fit: cover; height: 200px;">
                            <div class="card-body d-flex flex-column">
                                <div class="text-end mb-3">
                                    <span class="badge bg-primary text-white">Comments: {{ $post->comments_count }}</span>
                                </div>
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                                        class="btn btn-primary mb-2">View
                                        Post</a>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                            class="btn btn-outline-info me-2">Edit</a>
                                        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links('posts.partials.pagination') }} <!-- Render pagination links -->
            </div>
        @endif
    </div>
@endsection
