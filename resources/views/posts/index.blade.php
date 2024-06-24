@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="container my-5">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @foreach ($posts as $post)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">{{ $post->title }}</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
