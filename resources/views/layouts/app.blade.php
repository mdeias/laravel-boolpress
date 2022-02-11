<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <div class="container-fluid">

             

              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  
                <div class="navbar-nav">
                   

                     <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Vai al sito</a>
                       
                   
                  @auth
                                       
                  <a class="nav-link" href="{{route('admin.posts.index')}}">Home</a>
                     <a class="nav-link" href="{{route('admin.posts.create')}}">Crea nuovo post</a>
                     <a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
                     
                  @endauth

                </div>

              </div>
              <div class="navbar-nav">

                  @auth
                    <a  class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  @endauth
                  @guest
                  <a class="nav-link" href="{{ route('login') }}">Login</a>
                  <a class="nav-link" href="{{ route('register') }}">Register</a>
                  @endguest
              </div>

            </div>

          </nav>
    </header>
    

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
