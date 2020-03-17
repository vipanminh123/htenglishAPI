<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LE Admin | @yield('title')</title>
    
    <link href="{{URL::asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{URL::asset('public/assets/css/toastr.min.css')}}" rel="stylesheet">

     @yield('add-style')

    <link href="{{URL::asset('public/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/style.css')}}" rel="stylesheet">
   
</head>

<body class="@yield('body_class')">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" style="max-width: 100%" class="img-circle" src="{{ Auth::user()->avatar ? '/public/'.Auth::user()->avatar : asset('/public/assets/images/default-profile-img.png') }}" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth::user()->name}}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            <img alt="image" style="max-width: 100%" class="img-circle" src="{{ Auth::user()->avatar ? '/public/'.Auth::user()->avatar : asset('/public/assets/images/default-profile-img.png') }}" />
                        </div>
                    </li>

                    @include('admin.menu.custom-menu', array('admin_menu' => Menu::get('admin_menu') ))

                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to Admin Page</span>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>@yield('title-page')</h2>
                    <ol class="breadcrumb">
                        @yield('breadcrumb')                        
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <div class="notifications" style="padding: 0 10px">
                @if (Session::has('success'))
                    <div class="alert alert-info alert-dismissable animated fadeInDown" style="margin-top: 20px;">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('error'))
                    <div class="alert alert-danger alert-dismissable animated fadeInDown" style="margin-top: 20px;">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('error') }}
                    </div>
                @elseif (count($errors) > 0)
                    <div class="alert alert-danger  alert-dismissable animated fadeInDown" style="margin-top: 20px;">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="footer">
                <div class="text-center">
                    <strong>Copyright</strong> Example Company &copy; 2017-2018
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{URL::asset('public/assets/js/jquery-2.1.1.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/jquery.metisMenu.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/jquery.slimscroll.min.js')}}"></script>
    <!-- Custom and plugin javascript -->
    <script src="{{URL::asset('public/assets/js/script.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/pace.min.js')}}"></script>

    <script src="{{URL::asset('public/assets/js/admin.js')}}"></script>

    @yield('add-script')
</body>

</html>