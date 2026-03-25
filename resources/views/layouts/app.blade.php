<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VELOX</title>

    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

    <style>
        html, body{
            height: 100%;
        }

        #app{
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main{
            flex: 1;
        }
        body{
            background: #f5f7fb;
            color: #111827;
        }

        .main-navbar{
            background: linear-gradient(135deg, rgba(10,12,16,1) 0%, rgba(20,24,34,1) 65%, rgba(13,110,253,.18) 100%) !important;
            box-shadow: 0 12px 35px rgba(0,0,0,.16);
            padding: 14px 0;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .navbar-brand{
            color: #fff !important;
            font-size: 1.4rem;
            font-weight: 900;
            letter-spacing: .4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-badge{
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.12);
            font-size: 18px;
            box-shadow: 0 8px 18px rgba(0,0,0,.18);
        }

        .navbar-nav .nav-link{
            color: rgba(255,255,255,.86) !important;
            font-weight: 600;
            padding: 10px 14px !important;
            border-radius: 999px;
            transition: .2s ease;
        }

        .navbar-nav .nav-link:hover{
            color: #fff !important;
            background: rgba(255,255,255,.08);
        }

        .navbar-nav .dropdown-toggle{
            background: rgba(255,255,255,.08);
        }

        .auth-link{
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(255,255,255,.06);
        }

        .register-link{
            background: #0d6efd;
            color: #fff !important;
            box-shadow: 0 10px 20px rgba(13,110,253,.25);
        }

        .register-link:hover{
            background: #0b5ed7;
        }

        .navbar-toggler{
            border: 1px solid rgba(255,255,255,.18);
            padding: 8px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,.06);
        }

        .navbar-toggler:focus{
            box-shadow: none;
        }

        .navbar-toggler-icon{
            filter: invert(1);
        }

        .dropdown-menu{
            border: 1px solid rgba(0,0,0,.08);
            box-shadow: 0 14px 30px rgba(0,0,0,.12);
            border-radius: 14px;
            padding: 8px;
        }

        .dropdown-item{
            border-radius: 10px;
            padding: 10px 12px;
            font-weight: 600;
        }

        .dropdown-item:hover{
            background: #f1f5ff;
        }

        main{
            min-height: calc(100vh - 180px);
        }

        .site-footer{
            margin-top: 40px;
            padding: 38px 0 24px;
            background: linear-gradient(135deg, rgba(10,12,16,1) 0%, rgba(20,24,34,1) 65%, rgba(13,110,253,.14) 100%);
            color: rgba(255,255,255,.88);
            border-top: 1px solid rgba(255,255,255,.08);
            box-shadow: 0 -10px 30px rgba(0,0,0,.08);
        }

        .footer-brand{
            max-width: 360px;
        }

        .footer-logo{
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .footer-logo-badge{
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.12);
            box-shadow: 0 8px 18px rgba(0,0,0,.18);
            font-size: 18px;
        }

        .footer-logo-text{
            font-size: 1.3rem;
            font-weight: 900;
            letter-spacing: .4px;
            color: #fff;
        }

        .footer-title{
            color: #fff;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .footer-text{
            color: rgba(255,255,255,.75);
            line-height: 1.7;
            margin: 0;
        }

        .footer-links{
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li{
            margin-bottom: 10px;
            color: rgba(255,255,255,.78);
        }

        .footer-links a{
            color: rgba(255,255,255,.78);
            text-decoration: none;
            transition: .2s ease;
        }

        .footer-links a:hover{
            color: #fff;
        }

        .footer-note{
            color: rgba(255,255,255,.62);
            font-size: .95rem;
        }

        @media (max-width: 767px){
            .navbar-collapse{
                margin-top: 14px;
                padding: 14px;
                border-radius: 16px;
                background: rgba(255,255,255,.06);
                border: 1px solid rgba(255,255,255,.08);
            }

            .navbar-nav .nav-link{
                margin-bottom: 6px;
            }
        }

        @media (max-width: 768px){
            .site-footer{
                padding: 30px 0 20px;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md main-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    VELOX
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('catalog') }}">{{ __('Каталог') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('magazin') }}">Где находимся</a>
                        </li>
                        <li class="nav-item">
                            @if(isset(Auth::user()->id))
                                @if(Auth::user()->role_id==2)
                                    <a class="nav-link" href="{{ route('admin') }}">Admin</a>
                                @endif
                            @endif
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link auth-link" href="{{ route('login') }}">{{ __('Авторизация') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ms-md-2">
                                    <a class="nav-link register-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Профиль') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
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

        <footer class="site-footer">
            <div class="container">
                <div class="row g-4 align-items-start">

                    <div class="col-12 col-lg-4">
                        <div class="footer-brand">
                            <div class="footer-logo">
                                <span class="footer-logo-text">VELOX</span>
                            </div>
                            <p class="footer-text">
                                Современный автосалон с удобным каталогом, прозрачными условиями и автомобилями,
                                которые приятно выбирать.
                            </p>
                        </div>
                    </div>

                    <div class="col-6 col-lg-2">
                        <h6 class="footer-title">Навигация</h6>
                        <ul class="footer-links">
                            <li><a href="{{ url('/') }}">Главная</a></li>
                            <li><a href="{{ route('catalog') }}">Каталог</a></li>
                            <li><a href="{{ route('magazin') }}">Контакты</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-lg-3">
                        <h6 class="footer-title">Контакты</h6>
                        <ul class="footer-links">
                            <li><a href="tel:+79127485378">+7 (912) 74-85-378</a></li>
                            <li><a href="mailto:maa2018mlp@gmail.com">maa2018mlp@gmail.com</a></li>
                            <li>Ижевск, Пушкинсая 268А</li>
                        </ul>
                    </div>

                    <div class="col-12 col-lg-3">
                        <h6 class="footer-title">VELOX</h6>
                        <p class="footer-text mb-2">
                            Твой следующий автомобиль начинается с VELOX.
                        </p>
                        <div class="footer-note">
                            © {{ date('Y') }} VELOX. Все права защищены.
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div>
</body>
</html>