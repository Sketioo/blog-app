@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" style="background: red; padding: 10px; font-size: 25px;">
            {{ session('status') }}
        </div>
    @endif

    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn">
            Edit
        </a>
        <hr>
    @endforeach

@endsection
