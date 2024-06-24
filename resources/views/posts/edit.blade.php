@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
        @method('PUT')
        @include('posts.partials.form')
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
@endsection
