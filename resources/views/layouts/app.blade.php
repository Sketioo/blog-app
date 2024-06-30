<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Laravel - @yield('title')</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm p-2">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('home.index') }}">Blog Kita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home.contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('posts.index') }}">All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('posts.create') }}">Create Post</a>
                    </li>

                    @guest
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout ({{ Auth::user()->name }})</a>
                        </li>

                        <form action="{{ route('logout') }}" id="logout-form" method="post" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container flex-grow-1">
        @yield('content')
    </div>

    <footer class="footer mt-auto bg-secondary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="me-md-3">&copy; {{ date('Y') }} Blog Kita</span>
                    <a href="{{ route('home.contact') }}" class="text-white">Contact Us</a>
                </div>
                <div class="col-md-6 text-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white">Facebook</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">Twitter</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
