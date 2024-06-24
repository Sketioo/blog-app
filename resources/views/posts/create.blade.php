@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Create Post</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            @include('posts.partials.form')

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Create Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
