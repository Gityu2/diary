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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/favorite.css') }}" rel="stylesheet">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="height: 7vh; ">
            <div class="container">
                
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                </div>


                    <!-- Left Side Of Navbar -->


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
                            <li class="nav-item dropdown">
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
            </div>
        </nav>

        
        @if (request()->is('diary/*'))
        <main>
            <div class="row mx-0">
                <div class="col-2 p-0 min-vh-93 feature_nav">
                    <div class="list-group mt-3 px-2">
                        <a href="{{ route('diary.day.create') }}" class="list-group-item {{ request()->is('diary/day/create') ? 'text-white':''}}"><i class="fa-solid fa-file-circle-plus"></i> New Entry (Day)</a>
                        <a href="{{ route('diary.day.show.regular.list') }}" class="list-group-item {{ request()->is('diary/day/show/regular/*') ? 'text-white':''}}"><i class="fa-solid fa-calendar-days"></i> Reglarly Reveiw</a>
                        <a href="{{ route('diary.month.show.list') }}" class="list-group-item {{ request()->is('diary/month/show/*') ? 'text-white':''}}"><i class="fa-solid fa-calendar-days"></i> Monthly  Reveiw</a>
                        <a href="{{ route('diary.year.show') }}" class="list-group-item {{ request()->is('diary/year/show') ? 'text-white':''}}"><i class="fa-solid fa-calendar-days"></i> Yearly   Reveiw</a>
                        <a href="{{ route('diary.like.show.list') }}" class="list-group-item {{ request()->is('diary/like/show/*') ? 'text-white':''}}"><i class="fa-solid fa-heart"></i> Favorite</a>
                        <form action="{{ route('diary.search.show.list') }}" method="get" class="list-group-item">
                            @csrf
                            <div class="input-group">
                                <span class="input-group-text px-1"><i class="fa-solid fa-magnifying-glass" style="font-size:0.8rem"></i></span>
                                <input type="text" name="keyword" class="form-control" placeholder="Search">
                                <button type="submit" class=" form-control bg-secondary text-white px-0" style="display:none;"></button>
                            </div>
                        </form>

                    </div>
                        <a type="button" class="ms-4 text-decoration-none text-danger" style="font-size: 0.8rem;" data-bs-toggle="modal" data-bs-target="#delete-account">
                            Delete your account
                        </a>
                </div>
                @include('layouts.modal.status')
                    
                <div class="col-10 p-0">
                    @yield('content')
                </div>
            </div>
            
            @else
            @yield('content')
            @endif
            
        </main>
        
    </div>
</body>
</html>
