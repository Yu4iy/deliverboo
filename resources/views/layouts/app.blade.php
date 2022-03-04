<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <header>
            <div class="container container-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a href="/" class="container-brand">
                            <span class="cursor-pointer">
                                <img
                                    src="/storage/header/logo-deliveroo-icona.png"
                                    alt="deliveboo-logo"
                                    class="logo"
                                />
                                deliveboo
                            </span>
                        </a>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div
                            class="collapse navbar-collapse"
                            id="navbarSupportedContent"
                        >
                        @auth
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link cursor-pointer @if (Request::route()->getName()==='admin.dishes.index')
                            active
                        @endif" href="{{ route('admin.dishes.index') }}">Dishes</a>
                            </li>
                        </ul>
                        @endauth
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link cursor-pointer" 
                                    aria-current="page"
                                    href="{{ route('login') }}">
                                        <i
                                            class="fa-solid fa-arrow-right-to-bracket icon-header"
                                        ></i>
                                        {{ __('Login') }}
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a
                                        class="nav-link cursor-pointer"
                                        aria-current="page"
                                        href="{{ route('register') }}">
                                        <i
                                            class="fa-solid fa-house icon-header"
                                        ></i>
                                        {{ __('Register') }}
                                    </a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle cursor-pointer" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item cursor-pointer" href="{{ route('logout') }}" onclick="event.preventDefault();
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
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('vue')
    @yield('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    {{-- Script Js --}}

</body>

</html>