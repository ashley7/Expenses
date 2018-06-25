<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
 


   <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> 

  
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    HOME
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                       
                        <!-- Authentication Links -->

                        @guest
                            <!-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li> -->
                            <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
                        @else                        
                          <li><a class="nav-link navbar-brand" style="text-transform: uppercase;" href="{{route('reports.create')}}">Report</a></li>
                          <li><a class="nav-link navbar-brand" style="text-transform: uppercase;" href="{{route('account.index')}}">Accounts</a></li>
                          <li><a class="nav-link navbar-brand" style="text-transform: uppercase;" href="{{route('expense.index')}}">Expenses</a></li>

                          <li>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
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

    @stack('scripts')
</body>
</html>
