@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('posts.store') }}" method="post">
        @include('posts.partials.form')
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
@endsection
