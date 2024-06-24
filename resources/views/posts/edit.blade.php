@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Edit Post</h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm">
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
