@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
  <div class="container my-5">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      @foreach ($posts as $post)
        <div class="col">
          <div class="card shadow-sm h-100">
            <img src="{{ asset('https://contenthub-static.grammarly.com/blog/wp-content/uploads/2022/08/BMD-3398.png') }}" alt="{{ $post->title }}" class="card-img-top">  <div class="card-body d-flex flex-column justify-content-between">
              <div class="text-end">
                <span class="badge bg-primary text-white">Comments: {{ $post->comments_count }}</span>
              </div>
              <h3 class="card-title">{{ $post->title }}</h3>
              <p class="card-text">{{ Str::limit($post->content, 100) }}</p> <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection


