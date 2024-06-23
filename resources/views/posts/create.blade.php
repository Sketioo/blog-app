@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <form action="{{ route('posts.store') }}" method="post">
        <div>
            @csrf
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" >
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" ></textarea>
        </div>
        <button type="submit">Create Post</button>
    </form>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            @endforeach
        </div>
    @endif
@endsection
