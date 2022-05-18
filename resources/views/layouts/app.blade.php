<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.4.3/css/flag-icons.min.css" integrity="sha512-uvXdJud8WaOlQFjlz9B15Yy2Au/bMAvz79F7Xa6OakCl2jvQPdHD0hb3dEqZRdSwG4/sknePXlE7GiarwA/9Wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div id="app">
        <nav class="navbar">
            <div class="container">
                <a class="tittle" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="navLinks">
                    @yield('header')
                    <a href="#">{{ __('translations.about') }}</a>
                </div>

                <div class="userLinks">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}">{{ __('translations.login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('translations.register') }}</a>
                        @endif

                    @else
                        <a class="toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ str_replace('_', '-', app()->getLocale()) }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('locale.setting', 'en') }}">
                                <span class="fi fi-gb"></span>  EN
                            </a>
                            <a class="dropdown-item" href="{{ route('locale.setting', 'es') }}">
                                <span class="fi fi-es"></span>  ES
                            </a>
                        </div>
                          
                        <a class="toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{ __('translations.profile') }}
                            </a>
                            <a class="dropdown-item red" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#">
                                {{ __('translations.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
<style>
    .navbar{
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        flex-wrap: nowrap;
        justify-content: flex-start;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
        --bs-bg-opacity: 1;
        background-color: #0070BF !important;
    }

    .navLinks {
        position: absolute;
        left: 20%;
    }

    .navLinks a{
        padding: 20px;
    }

    .userLinks {
        display: inline;
        float: right;
    }

    .userLinks a{
        padding: 10px;
    }

    a{
        font-size: 18px;
        color: white;
        text-decoration: none;
    }

    a:hover{
        color: white;
    }

    .tittle{
        font-size: 32px !important;
        font-weight: bold !important;
        color: white;
        text-decoration: none; /* no underline */
    }

    .tittle:hover{
        color: white;
    }

    .toggle{
        white-space: nowrap;
    }

    .toggle::after{
        display: inline-block;
        margin-left: 0.255em;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
    }

    .red{
        color: red !important;
    }

    /* LOGIN */

    .login-container{
        width: 45%;
        flex: 0 0 auto;
    }

    .login-tittle{
        margin: 10px auto 10px;
    }

    .login-input-container{
        margin: 0 auto;
        width: 75%
    }

    .login-button-container {
        width: 80%;
        display: flex;
        margin: 0 auto;
    }

    .login-button{
        width: 80%;
        margin: 20px auto;
        justify-self: center;
    }

</style>
</html>
