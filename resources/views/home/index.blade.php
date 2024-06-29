@extends('layouts.app')

@section('title', 'Welcome to [Website Name]')

@section('content')
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4">Explore the World of Programming</h1>
                <p class="lead">Stay up-to-date with the latest trends and insights in the ever-evolving world of
                    programming. We publish informative and engaging blog posts on various programming topics to help you
                    learn, grow, and excel as a developer.</p>
                <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg">Browse Recent Posts</a>
            </div>

            <div class="col-md-4 d-none d-md-block">
                <img src="{{ asset('https://picsum.photos/id/1026/600/400') }}" alt="Programming Illustration"
                    class="img-fluid rounded-end">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('https://picsum.photos/id/1027/300/200') }}" alt="Blog Post 1" class="card-img-top">
                    <div class="card-body">
                        <h3><a href="#">Intriguing Headline for Programming Blog Post 1</a></h3>
                        <p class="card-text">A short and captivating excerpt to entice readers to learn more about Blog Post
                            1.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('https://picsum.photos/id/1028/300/200') }}" alt="Blog Post 2" class="card-img-top">
                    <div class="card-body">
                        <h3><a href="#">Intriguing Headline for Programming Blog Post 2</a></h3>
                        <p class="card-text">A short and captivating excerpt to entice readers to learn more about Blog Post
                            2.</p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('https://picsum.photos/id/1029/300/200') }}" alt="Blog Post 3" class="card-img-top">
                    <div class="card-body">
                        <h3><a href="#">Intriguing Headline for Programming Blog Post 3</a></h3>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
