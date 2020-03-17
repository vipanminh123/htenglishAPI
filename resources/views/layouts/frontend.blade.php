<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HT Learn English | @yield('title')</title>
    <link href="{{URL::asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/font-awesome.min.css')}}" rel="stylesheet"> 

    @yield('add-style')

    <link href="{{URL::asset('public/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/frontend.css')}}" rel="stylesheet">
</head>

<body class="top-navigation @yield('body_class')">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="/" class="navbar-brand">HT Learn English</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li><a aria-expanded="false" href="/lesson">100 English Lessons</a></li>
                            <li><a aria-expanded="false" href="/phrases">1000 Most Common English Phrases</a></li>
                            <li><a aria-expanded="false" href="/word">1000 Most Common English Words</a></li>
                            <li><a aria-expanded="false" href="/guide">Guide</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @if (Route::has('login'))
                                @if (Auth::check())
                                    <li class="dropdown">
                                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
                                        <ul role="menu" class="dropdown-menu">
                                            <li>
                                                <a href="{{ url('/profile') }}"><i class="fa fa-sign-out"></i> Profile</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i> Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>                                    
                                @else
                                    <li>
                                        <a href="{{ url('/login') }}">Login</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/register') }}">Register</a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="notifications">
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
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="container">
                    <div class="row">
                        @yield('content')

                        @if(Auth::check())
                            <div class="col-md-3 ht-sidebar">
                                <div class="ibox-content">
                                    <h3>Phrases</h3>
                                    <ul class="folder-list sidebar-list" style="padding: 0">
                                        <li class="@yield('all-phrases')"><a href="/phrases"><i class="fa fa-hand-o-right"></i> All Phrases</a></li>
                                        <li class="@yield('phrases-storage')"><a href="/phrases/storage"><i class="fa fa-hand-o-right"></i> Phrases Storage</a></li>
                                        <li class="@yield('learn-phrases')">
                                            <span><i class="fa fa-hand-o-right"></i> Learn Phrases</span>
                                            <ul>
                                                <li class="@yield('phrases-engtoviet')"><a href="/phrases/learn/engtoviet"><i class="fa fa-hand-o-right"></i> Englist to Vietnamese</a></li>
                                                <li class="@yield('phrases-viettoeng')"><a href="/phrases/learn/viettoeng"><i class="fa fa-hand-o-right"></i> Vietnamese to English</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="hr-line-dashed"></div>
                                    <h3>Words</h3>
                                    <ul class="folder-list sidebar-list" style="padding: 0">
                                        <li class="@yield('all-words')"><a href="/word"><i class="fa fa-hand-o-right"></i> All words</a></li>
                                        <li class="@yield('words-storage')"><a href="/word/storage"><i class="fa fa-hand-o-right"></i> Words storage</a></li>
                                        <li class="@yield('learn-words')">
                                            <span><i class="fa fa-hand-o-right"></i> Learn Word</span>
                                            <ul>
                                                <li class="@yield('words-engtoviet')"><a href="/word/learn/engtoviet"><i class="fa fa-hand-o-right"></i> Englist to Vietnamese</a></li>
                                                <li class="@yield('words-viettoeng')"><a href="/word/learn/viettoeng"><i class="fa fa-hand-o-right"></i> Vietnamese to English</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div class="hr-line-dashed"></div>
                                    <h3>Lesson</h3>
                                    <ul class="folder-list sidebar-list" style="padding: 0">
                                        <li class="@yield('all-lessons')"><a href="/lesson"><i class="fa fa-hand-o-right"></i> All Lessons</a></li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>                    
                </div>
            </div>
            <div class="footer">
                <div class="text-center">
                    <strong>Copyright</strong> NST-Ikulee &copy; 2018-2019
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

    <script src="{{URL::asset('public/assets/js/frontend.js')}}"></script>

    @yield('add-script')

</body>

</html>