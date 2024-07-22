<!-- index.blade.php -->
@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="container my-5">
        @include('posts.partials.search')
        @if ($posts->isEmpty())
            <div class="alert alert-info" role="alert">
                There are currently no posts available.
            </div>
        @else
            <div class="row">
                <!-- Left Column for Posts -->
                <div class="col-lg-8">
                    <ul class="list-group">
                        @foreach ($posts as $post)
                        <li class="list-group-item py-3">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="text-decoration-none text-dark">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 text-primary">{{ $post->title }}</h5>
                                        <p class="mb-1 text-secondary">{{ Str::limit($post->content, 150) }}</p>
                                        <small class="text-muted">Posted by <strong>{{ $post->user->name }}</strong></small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary text-white my-1">Comments: {{ $post->comments_count }}</span>
                                        <span class="btn btn-outline-primary btn-sm mt-2">Read More</span>
                                    </div>
                                </div>
                            </a>
                        </li>                        
                        @endforeach
                    </ul>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $posts->links('posts.partials.pagination') }} <!-- Pagination links -->
                    </div>
                </div>
                <!-- Right Column for Most Active User and Most Commented Post -->
                <div class="col-lg-4">
                    <!-- Most Commented Posts Card -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            Most Commented
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2">What people are currently talking about</p>
                            <ul class="list-group list-group-flush">
                                @foreach ($mostCommentedPosts as $post)
                                    <li class="list-group-item">
                                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-primary">{{ $post->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                
                    <!-- Most Active Users Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            Most Active Users Last Month
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2">Users with most posts written</p>
                            <ul class="list-group list-group-flush">
                                @foreach ($mostActiveUsers as $user)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/30" class="rounded-circle me-3" alt="User Image">
                                            <div>{{ $user->name }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            Most Active Last Month
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2">Users with most posts last month</p>
                            <ul class="list-group list-group-flush">
                                @foreach ($mostUsersPostLastMonth as $user)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/30" class="rounded-circle me-3" alt="User Image">
                                            <div>{{ $user->name }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif
    </div>
@endsection
