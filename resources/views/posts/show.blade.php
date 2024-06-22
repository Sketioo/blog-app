@extends('layouts.app')

@section('title', $post['title'])

@section('content')

    @if ($post['is_new'])
        <div>
            This is a new post
        </div>
    @elseif(!$post['is_new'])
        <div>
            This is an old post
        </div>
    @endif
    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>

    @isset($post['has_comment'])
      <div>
        This post has a comment
      </div>
    @endisset
@endsection
