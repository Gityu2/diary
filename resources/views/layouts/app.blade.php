<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>4S Diary - @yield('title')</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    @yield('style')

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">

</head>
<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('diary.day.create') }}">
            <img src="{{ asset('images/logo-white.png') }}" alt="4S Diary" style="height: 30px">
        </a>
        <!-- Sidebar Toggle-->
        @if (request()->is('diary/*' , 'admin/*'))
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto ">
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
                    <li class="nav-item dropdown ms-3 me-5">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
    </nav>

    @if (request()->is('diary/*' , 'admin/*'))
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        @if (Auth::user()->role_id == 2)
                        <form action="{{ route('diary.search.show.list') }}" method="get" class="px-3 mt-3">
                            @csrf
                            <div class="input-group">
                                <span class="input-group-text px-1"><i class="fa-solid fa-magnifying-glass" style="font-size:0.8rem"></i></span>
                                <input type="text" name="keyword" class="form-control h-25" placeholder="Search" >
                                <button type="submit" class=" form-control" style="display:none;"></button>
                            </div>
                        </form>
                        <a href="{{ route('diary.day.create') }}" class="nav-link {{ request()->is('diary/day/create') ? 'text-white':''}}"><i class="fa-solid fa-file-circle-plus list_icon"></i> New Entry (Day)</a>
                        <a href="{{ route('diary.day.show.regular.list') }}" class="nav-link {{ request()->is('diary/day/show/regular/*') ? 'text-white':''}}"><i class="fa-solid fa-calendar-days list_icon"></i> Reglarly Reveiw</a>
                        <a href="{{ route('diary.month.show.list') }}" class="nav-link {{ request()->is('diary/month/show/*') ? 'text-white':''}}"><i class="fa-solid fa-calendar-days list_icon"></i> Monthly  Reveiw</a>
                        <a href="{{ route('diary.year.show') }}" class="nav-link {{ request()->is('diary/year/show') ? 'text-white':''}}"><i class="fa-solid fa-calendar-days list_icon"></i> Yearly   Reveiw</a>
                        <a href="{{ route('diary.like.show.list') }}" class="nav-link {{ request()->is('diary/like/show/*') ? 'text-white':''}}"><i class="fa-solid fa-heart list_icon"></i> Favorite</a>
                        <a type="button" class="ms-4 text-decoration-none text-danger list_icon" style="font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#delete-account" >
                            Delete your account
                        </a>
                        @endif
                        @if (Auth::user()->role_id == 1)
                        <a href="{{ route('admin.show.dashboard') }}" class="nav-link {{ request()->is('diary/like/show/*') ? 'text-white':''}}"><i class="fa-solid fa-chart-line list_icon"></i></i> Dashboard</a>
                        @endif

                    </div>
                </div>
            </nav>
        </div>
        @include('layouts.modal.status')
        @endif

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>



