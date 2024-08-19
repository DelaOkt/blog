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
                <!-- Home Button -->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                    <i class="fas fa-home"></i> <!-- Ikon Rumah -->
                </button>
                <h1 class="text-white ms-3">BLOG</h1>
            </div>
        </nav>

        <!-- Sidebar Menu -->
        <div class="offcanvas offcanvas-start bg-primary text-white" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <!-- Menampilkan peran pengguna -->
                    <li class="nav-item">
    <a class="nav-link text-white" href="#">
        @if(auth()->check())
            @if(auth()->user()->isAdmin())
                <i class="fas fa-crown"></i> <!-- Ikon Admin -->
                Admin
            @else
                <i class="fas fa-user"></i> <!-- Ikon Pengguna -->
                Pengguna
            @endif
        @endif
    </a>
</li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/') }}">
                            <i class="fas fa-home"></i> <!-- Ikon Rumah -->
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('categories.index') }}">
                            <i class="fas fa-list"></i> <!-- Ikon Daftar -->
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('posts.index') }}">
                            <i class="fas fa-pen"></i> <!-- Ikon Post -->
                            Post
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i> <!-- Ikon Pengguna -->
                            Akun
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> <!-- Ikon Login -->
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> <!-- Ikon Register -->
                                Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> <!-- Ikon Logout -->
                                Logout
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                    @endguest
                </ul>
            </div>
        </div>

        <!-- Content -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
