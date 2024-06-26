@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow rounded-lg border-primary">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Create Post</h3> <a href="{{ route('posts.index') }}"
                            class="btn btn-light btn-sm">All Posts</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            @include('posts.partials.form') <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
