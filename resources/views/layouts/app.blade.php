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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/tone@13.8.25/build/Tone.js"> </script>

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
        <nav class="navbar" id="navbar">
            @auth
                <i class="bi bi-list nav-icon" id="nav-icon"></i>
            @endauth

            <a class="tittle" href="{{ url('/') }}">
                <svg
                    width="25.612679mm"
                    height="7.3342495mm"
                    viewBox="0 0 25.612679 7.3342495"
                    version="1.1"
                    id="logo"
                    sodipodi:docname="logo.svg"
                    inkscape:version="1.1.1 (3bf5ae0d25, 2021-09-20)"
                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:svg="http://www.w3.org/2000/svg">
                        <g
                            inkscape:label="Capa 1"
                            inkscape:groupmode="layer"
                            id="layer1"
                            transform="translate(-1.9545391,-21.656319)">
                            <g
                                aria-label="FitMe"
                                id="text1112"
                                style="font-size:9.525px;line-height:1.25;font-family:'Noto Sans';-inkscape-font-specification:'Noto Sans';stroke-width:0.264583">
                                <path
                                    id="path26762"
                                    style="font-weight:bold;-inkscape-font-specification:'Noto Sans Bold';fill:#ffffff"
                                    d="m 25.233593,23.599419 q 1.076325,0 1.704975,0.619125 0.62865,0.6096 0.62865,1.743075 v 0.6858 h -3.3528 q 0.01905,0.600075 0.352425,0.942975 0.3429,0.3429 0.942975,0.3429 0.4953,0 0.904875,-0.09525 0.4191,-0.104775 0.85725,-0.314325 v 1.095375 q -0.390525,0.1905 -0.809625,0.276225 -0.4191,0.09525 -1.019175,0.09525 -0.78105,0 -1.381125,-0.28575 -0.600075,-0.295275 -0.942975,-0.8763 -0.3429,-0.59055 -0.3429,-1.495425 0,-0.904875 0.3048,-1.514475 0.314325,-0.6096 0.866775,-0.9144 0.55245,-0.3048 1.285875,-0.3048 z m 0.0095,1.00965 q -0.4191,0 -0.6858,0.2667 -0.2667,0.2667 -0.314325,0.828675 h 1.990725 q -0.0095,-0.466725 -0.257175,-0.78105 -0.238125,-0.314325 -0.733425,-0.314325 z m -8.143839,4.28625 -1.6383,-5.334 h -0.0381 q 0.0095,0.1905 0.02858,0.5715 0.01905,0.381 0.0381,0.81915 0.01905,0.43815 0.01905,0.78105 v 3.1623 h -1.285875 v -6.80085 h 1.96215 l 1.609725,5.20065 h 0.02858 l 1.704974,-5.20065 h 1.96215 v 6.80085 h -1.343025 v -3.21945 q 0,-0.32385 0.0095,-0.74295 0.01905,-0.4191 0.02858,-0.790575 0.01905,-0.381 0.02858,-0.5715 h -0.0381 l -1.752599,5.324475 z m -4.933932,-1.038225 q 0.238125,0 0.4572,-0.0381 0.219075,-0.04763 0.43815,-0.123825 v 1.057275 q -0.2286,0.104775 -0.5715,0.17145 -0.333375,0.06668 -0.733425,0.06668 -0.466725,0 -0.8382,-0.1524 -0.36195,-0.1524 -0.581025,-0.523875 -0.20955,-0.371475 -0.20955,-1.04775 v -2.50508 H 9.4506967 v -0.600075 l 0.7810503,-0.47625 0.409575,-1.095375 h 0.904875 v 1.1049 h 1.457325 v 1.0668 h -1.457325 v 2.505075 q 0,0.295275 0.17145,0.447675 0.17145,0.142875 0.447675,0.142875 z M 7.7838368,21.656319 q 0.314325,0 0.542925,0.1524 0.2286,0.142875 0.2286,0.542925 0,0.390525 -0.2286,0.542925 -0.2286,0.1524 -0.542925,0.1524 -0.32385,0 -0.55245,-0.1524 -0.219075,-0.1524 -0.219075,-0.542925 0,-0.40005 0.219075,-0.542925 0.2286,-0.1524 0.55245,-0.1524 z m 0.70485,2.03835 v 5.20065 h -1.419225 v -5.20065 z M 3.373764,28.895319 H 1.9545391 v -6.80085 h 3.8957248 v 1.1811 H 3.373764 v 1.7526 h 2.3050499 v 1.1811 H 3.373764 Z" />
                            </g>
                        </g>
                </svg>
            </a>

            <div class="navLinks" id="navLinks">
                @yield('header')
            </div>
            
            <div class="userLinks">
                    <!-- Authentication Links -->
                    @guest
                        <a class="toggle lang-selector" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

                        @if (Route::has('login'))
                            <a href="{{ route('login') }}">{{ __('translations.login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('translations.register') }}</a>
                        @endif

                    @else
                        <a class="toggle lang-selector" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        align-items: center;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        flex-wrap: wrap;
        padding-right: 8%;
        padding-left: 8%;
        justify-content: space-between;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
        --bs-bg-opacity: 1;
        background-color: #0070BF !important;
    }

    .nav-icon{
        display: none;
        color: white;
        font-size: 25px;
        cursor: pointer;
    }

    @media (max-width: 880px) {
        .navbar{
            max-height: 67.2px;
            transition: max-height 1s ease-out;
            overflow: hidden;
        }

        .navLinks{
            display: grid;
            width: 100%;
            order: 4;
        }

        .userLinks{
            flex: 1;    
            justify-content: flex-end;
            display: flex !important;
        }

        .nav-icon{
            display: inline;
            flex: 1;
        }

        .nav-open{
            max-height: 1000px;
            transition: max-height 1s ease-in;
        }
    }

    @media (max-width: 650px) {
        .lang-selector{
            display: none
        }
    }

    .navLinks {
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

    @media (max-width: 1200px) {
        .login-container{
            width: 65%;
        }
    }

    @media (max-width: 950px) {
        .login-container{
            width: 75%;
        }
    }

    @media (max-width: 700px) {
        .login-container{
            width: 90%;
        }
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
<script>
    window.onload = ()=>{
        document.getElementById('nav-icon').addEventListener('click', function(){
            document.getElementById('navLinks').classList.toggle('open-menu');
            document.getElementById('navbar').classList.toggle('nav-open');
        });
    }
</script>
</html>
