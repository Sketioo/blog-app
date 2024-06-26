@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow rounded-lg border-primary">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Edit Post</h3> <a href="{{ route('posts.show', $post->id) }}"
                            class="btn btn-light btn-sm">View Post</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @include('posts.partials.form')

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">Update Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
