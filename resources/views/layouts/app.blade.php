<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ env('DIRLIB') }}MDBootstrap 5 v2.0.0/js/mdb.min.js" defer></script>
    <script type="text/javascript" src="{{ env('DIRLIB') }}DataTables/datatables.min.js" defer></script>
{{--     <script type="text/javascript" src="{{ env('DIRLIB') }}DataTables/DataTables-1.10.24/js/jquery.DataTables.min.js" defer></script> --}}
    <script src="{{ env('DIRLIB') }}tinymce/js/tinymce/tinymce.min.js" defer></script>
    <script src="{{ env('DIRLIB') }}tinymce/js/tinymce/jquery.tinymce.min.js" defer></script>
    <script src="{{ env('DIRLIB') }}js/jquery-3.5.1.min.js"></script>
    <script src="{{ env('DIRLIB') }}js/formHandler2.js"></script>
    <script src="{{ env('DIRLIB') }}js/typeahead.js" defer></script>
    <script src="{{ env('DIRLIB') }}fontawesome-5.13.0/js/all.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/ico" sizes="32x32" href="{{ asset('images/favico-bookManager.ico') }}">
{{--     <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> --}}
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#00FFFFFF">

    <link href="{{ env('DIRLIB') }}fontawesome-5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ env('DIRLIB') }}DataTables/datatables.min.css"/>
    <link href="{{ env('DIRLIB') }}MDBootstrap 5 v2.0.0/css/mdb.min.css" rel="stylesheet">
    <link href="{{ env('DIRLIB') }}DataTables/DataTables-1.10.24/css/jquery.DataTables.min.css" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm d-flex">
            <div class="container row">
                <div class="accueuilPart col-md-2">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        {{ config('app.name', 'SportManager') }}
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('Administration Adhérents') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index') }}">{{ __('Espace Livres') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jeux.index') }}">{{ __('Espace jeux') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservBook.index') }}">{{ __('Réservation de livres') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservJeu.index') }}">{{ __('Réservation de jeux') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
    </div>
</body>
</html>
