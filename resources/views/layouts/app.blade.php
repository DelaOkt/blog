<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand">BLOG</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <!-- Menu Beranda akan selalu tampil -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @else
                            @if(auth()->user()->isAdmin())
                                <!-- Admin Menu -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('posts.index') }}">Post</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.index') }}">Akun</a>
                                </li>
                            @else
                                <!-- User Menu -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
