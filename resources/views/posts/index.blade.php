@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" style="background: red; padding: 10px; font-size: 25px;">
            {{ session('status') }}
        </div>
    @endif

    @foreach ($posts as $post)
        <h2>{{ $post['title'] }}</h2>
        <p>{{ $post['content'] }}</p>
        <hr>
    @endforeach

@endsection
