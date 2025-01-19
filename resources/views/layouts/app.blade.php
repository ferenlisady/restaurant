<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('menu.index') }}">
                                    {{ __('Menus') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('restaurant.index') }}">
                                    {{ __('Restaurants') }}
                                </a>
                            </li>
                            @if(Auth::user()->role == 'resto')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('menu.create') }}">
                                        {{ __('Add Menu') }}
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('restaurant.create') }}">
                                        {{ __('Add Restaurant') }}
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->role == 'customer')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('order.index') }}">
                                        {{ __('My Orders') }}
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('aboutus') }}">
                                    {{ __('About Us') }}
                                </a>
                            </li>
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="dropdown me-5 mt-1">
                                <button class="btn dropdown-toggle" type="button" id="localeDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="border-color: grey; padding: 4px 10px; font-size: 14px;">
                                    {{ strtoupper(App::getLocale()) }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="localeDropdown">
                                    <li><a class="dropdown-item"
                                            href="{{ route('set-locale', ['locale' => 'en']) }}">English</a></li>
                                    <li><a class="dropdown-item" href="{{ route('set-locale', ['locale' => 'id']) }}">Bahasa
                                            Indonesia</a></li>
                                </ul>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.view', ['id' => Auth::user()->id]) }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="text-white" style="background-color: #183F23; bottom: 0; height: 70px;">
            <div class="container-fluid d-flex justify-content-center align-items-center h-100">
                <div class="text-center py-3">
                    <p class="mb-0">© ConnectFriend 2025 | Web Programming | Feren Lisady | 2602060911</p>
                </div>
            </div>
        </footer>
    </div>
</body>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex-grow: 1;
    }
</style>

</html>