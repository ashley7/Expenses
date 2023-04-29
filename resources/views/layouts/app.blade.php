<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Simple finance records system" name="description" />
        <meta content="Mpabaisi Technologies" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     
        <link rel="shortcut icon" href="/images/logo.png">   

        <link href="/purple/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/purple/assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.dataTables.min.css') }}"> 

        <style>
            body{
                background-color: #FFF !important;
            }
        </style>
        @yield('styles')

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom" style="background-color: #1062ea !important;">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                @guest

                @else

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                             {{ Auth::user()->name }} ({{Auth::user()->user_type}}) <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <a class="dropdown-item" href="{{ route('user.edit','Edit profile') }}">Change password</a>

                            <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>                           

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>

                    @endguest

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="/home" class="logo text-center">
                        <span class="logo-lg">
                            <img src="/images/logo.png" alt="" height="50"  style="background-color: #fff; border-radius: 5px;">
                         </span>
                        <span class="logo-sm">
                             <img src="/images/logo.png" alt="" height="24" style="background-color: #fff; border-radius: 5px;">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <!-- <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                             <i class="fe fe-menu"></i>
                         </button>
                    </li> -->
        
                    <li class="dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                           <span class="text-white" style="font-size: 30px">{{ config('app.name') }}</span>
                         </a>                        
                    </li>
                   
                </ul>
            </div>
        
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <div id="sidebar-menu">
                        @guest

                        @else
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="{{ url('home') }}"><span> HOME </span> </a>  
                                <a class="nav-link" style="text-transform: uppercase;" href="{{route('income.index')}}">Incomes</a>
                                <a class="nav-link" style="text-transform: uppercase;" href="{{route('expense.index')}}">Expenses</a>
                                <a class="nav-link" style="text-transform: uppercase;" href="{{route('services.index')}}">Services</a>  
                                <a class="nav-link" style="text-transform: uppercase;" href="{{route('sales.index')}}">Sales</a>
                                <a class="nav-link" style="text-transform: uppercase;" href="{{route('buyer.index')}}">Customers</a>
                                <a class="nav-link" style="text-transform: uppercase;" href="{{route('user.index')}}">Users</a>
                            </li>                        
                        </ul>
                        @endguest
                    </div> 
                                       

                    <div class="clearfix"></div>

                </div>             
            </div>
             

            <div class="content-page">
                <div class="content">                   
                    <div class="container-fluid"> 
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>     
                        @endif
                        <hr>
                        @yield('content')                      
                      
                    </div> 
                </div>

                <!-- Footer Start -->
                <footer class="footer" style="background-color: #1062ea !important;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                               <span class="text-white">Powered by Mpabaisi Technologies</span>
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                                <?php 
                                $checkkey = App\User::apearance();                                    
                                $status = $checkkey['status'];

                                $key = App\User::key();
                                ?> 
                                @if($status=="invalids")
                                    <a href="https://licence.agent.co.ug/licence/{{$key}}"><span class="text-white" style="float: right;">License is active until {{ $checkkey['date'] }}</span> </a>                                                                        
                                @endif
                            </div>
                           
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            

        </div>
      

       
        
        <div class="rightbar-overlay"></div>
         
        <script src="/purple/assets/js/vendor.min.js"></script>        
        @stack('scripts')
        
    </body>
</html>