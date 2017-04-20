<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>

    <meta name="description" content="@yield('keywords')">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ url("/img/favicon.png") }}">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon57.png") }}" sizes="57x57">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon72.png") }}" sizes="72x72">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon76.png") }}" sizes="76x76">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon114.png") }}" sizes="114x114">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon120.png") }}" sizes="120x120">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon144.png") }}" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon152.png") }}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ asset("/img/icon180.png") }}" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{{ asset("/css/bootstrap.min.css") }}">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="{{ asset("/css/plugins.css") }}">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{ asset("/css/main.css") }}">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="{{ asset("/css/themes.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/themes/passion.css") }}">
    <!-- END Stylesheets -->
    @section('css')

    @show
    @section('style')

    @show
            <!-- Modernizr (browser feature detection library) -->
    <script src="{{ asset("/js/vendor/modernizr-3.3.1.min.js") }}"></script>
    @if( isset($layui) )
        <link rel="stylesheet" href="{{ asset("/layui/css/layui.css") }}">
        <script src="{{ asset("/js/jquery.js") }}"></script>
        <script src="{{ asset("/layer/layer.js") }}"></script>
        <script src="{{ asset("/layui/layui.js") }}"></script>
    @endif

</head>
<body>
<!-- Page Wrapper -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available classes:

    'page-loading'      enables page preloader
-->
<div id="page-wrapper" class="page-loading">
    <!-- Preloader -->
    <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
    <!-- Used only if page preloader enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
    <div class="preloader">
        <div class="inner">
            <!-- Animation spinner for all modern browsers -->
            <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

            <!-- Text for IE9 -->
            <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
        </div>
    </div>
    <!-- END Preloader -->

    <!-- Page Container -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
        Available #page-container classes:

        'sidebar-light'                                 for a light main sidebar (You can add it along with any other class)

        'sidebar-visible-lg-mini'                       main sidebar condensed - Mini Navigation (> 991px)
        'sidebar-visible-lg-full'                       main sidebar full - Full Navigation (> 991px)

        'sidebar-alt-visible-lg'                        alternative sidebar visible by default (> 991px) (You can add it along with any other class)

        'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
        'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

        'fixed-width'                                   for a fixed width layout (can only be used with a static header/main sidebar layout)

        'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links (You can add it along with any other class)
    -->
    <div id="page-container" class="header-fixed-top sidebar-visible-lg-full sidebar-visible-xs sidebar-light">
        <!-- Alternative Sidebar -->
        <div id="sidebar-alt" tabindex="-1" aria-hidden="true">
            <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
            <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i class="fa fa-times"></i></a>

            <!-- Wrapper for scrolling functionality -->
            {{----------------------------------------右侧设置栏⬇️----------------------------------------------}}
            <div id="sidebar-scroll-alt">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Profile -->
                    <div class="sidebar-section">
                        <h2 class="text-light">账号设置</h2>
                        <form action="{{ url('/users/update') }}" method="post" class="form-control-borderless" onsubmit="return false;">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id()  : "Not Login" }}">
                            <div class="form-group">
                                <label for="side-profile-name">名称</label>
                                <input type="text" id="side-profile-name" name="name" class="form-control"
                                       value="{{ Auth::check() ? Auth::user()->name : "Not Login" }}">
                            </div>
                            <div class="form-group">
                                <label for="side-profile-email">Email</label>
                                <input type="email" id="side-profile-email" name="email" class="form-control"
                                       value="{{ Auth::check() ? Auth::user()->email : "Not Login" }}">
                            </div>
                            <div class="form-group">
                                <label for="side-profile-password">新密码</label>
                                <input type="password" id="side-profile-password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="side-profile-password-confirm">确认密码</label>
                                <input type="password" id="side-profile-password-confirm" name="password-confirm"
                                       class="form-control">
                            </div>
                            <div class="form-group remove-margin">
                                <button type="submit" class="btn btn-effect-ripple btn-primary"
                                        onclick="App.sidebar('close-sidebar-alt');">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- END Profile -->

                    <!-- Settings -*************************************************************************************->

                    {{--<div class="sidebar-section">
                        <h2 class="text-light">Settings</h2>
                        <form action="index.html" method="post" class="form-horizontal form-control-borderless" onsubmit="return false;">
                            <div class="form-group">
                                <label class="col-xs-7 control-label-fixed">Notifications</label>
                                <div class="col-xs-5">
                                    <label class="switch switch-success"><input type="checkbox" checked><span></span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-7 control-label-fixed">Public Profile</label>
                                <div class="col-xs-5">
                                    <label class="switch switch-success"><input type="checkbox" checked><span></span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-7 control-label-fixed">Enable API</label>
                                <div class="col-xs-5">
                                    <label class="switch switch-success"><input type="checkbox"><span></span></label>
                                </div>
                            </div>
                            <div class="form-group remove-margin">
                                <button type="submit" class="btn btn-effect-ripple btn-primary" onclick="App.sidebar('close-sidebar-alt');">Save</button>
                            </div>
                        </form>
                    </div>--}}
                    <!-- END Settings ***********************************************************-->
                </div>
                <!-- END Sidebar Content -->
            </div>
            {{----------------------------------------右侧设置栏⬆️️----------------------------------------------}}
            <!-- END Wrapper for scrolling functionality -->
        </div>
        <!-- END Alternative Sidebar -->

        <!-- Main Sidebar -->
        <div id="sidebar">
            <!-- Sidebar Brand -->
            <div id="sidebar-brand" class="themed-background">
                <a href="{{ url("/home") }}" class="sidebar-title">
                    <i class="fa fa-cube"></i> <span class="sidebar-nav-mini-hide">COOL<strong>Manager</strong></span>
                </a>
            </div>
            <!-- END Sidebar Brand -->

            <!-- Wrapper for scrolling functionality -->
            {{----------------------------------------左侧菜单栏⤵️----------------------------------------------}}
            <div id="sidebar-scroll">
                <!-- Sidebar Content -->
                <div class="sidebar-content" >
                    <!-- Sidebar Navigation -->
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ url("/home") }}" class=" active">
                                <i class="gi gi-compass sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">Home</span>
                            </a>
                        </li>
                        <li class="sidebar-separator">
                            <i class="fa fa-ellipsis-h"></i>
                        </li>
                        <?php $name = session('laravel-gettext-locale')?>
                        @foreach(\App\Repositories\HelpRepository::getMenu() as $per)
                            <li
                                    @foreach($per['children'] as $ch)
                                    @if($ch['display_name'] == \Route::currentRouteName())class="active" @endif
                                    @endforeach
                                    >
                                <a href="#" class="sidebar-nav-menu">
                                    @if(count($per['children']))
                                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                                    @endif
                                    @if($per['name'] == "Permission")
                                        <i class="fa fa-unlock-alt fa-fw"></i>
                                    @else
                                        <i class="fa fa-user fa-fw"></i>
                                    @endif


                                    <span class="sidebar-nav-mini-hide">{{ $per[$name] }}</span>
                                </a>
                                @if($per['children'])
                                    <ul>
                                        @foreach($per['children'] as $ch)
                                            @if($ch['type'] == 0)
                                                <li>
                                                    <a href="{{ $ch['display_name'] ? route($ch['display_name']) :'javascript:;' }}"
                                                       class="@if($ch['display_name'] == \Route::currentRouteName())active @endif">
                                                        {{--<i class="fa fa-chevron-left sidebar-nav-indicator">--}}
                                                        {{$ch[$name]}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach

                        <li class="sidebar-separator">
                            <i class="fa fa-ellipsis-h"></i>
                        </li>
                        {{--<li>--}}
                        {{--<a href="page_app_estore.html"><i class="gi gi-shopping_cart sidebar-nav-icon"></i>--}}
                        {{--<span class="sidebar-nav-mini-hide">eStore</span></a>--}}
                        {{--</li>--}}
                    </ul>
                    <!-- END Sidebar Navigation -->
                </div>
                <!-- END Sidebar Content -->
            </div>
            {{----------------------------------------左侧菜单栏⤴️----------------------------------------------}}
        </div>
        <!-- END Main Sidebar -->

        <!-- Main Container -->
        <div id="main-container">

            <header class="navbar navbar-inverse navbar-fixed-top">
                <!-- Left Header Navigation -->
                <ul class="nav navbar-nav-custom">
                    <!-- Main Sidebar Toggle Button -->
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                            <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                            <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                        </a>
                    </li>
                    <!-- END Main Sidebar Toggle Button -->

                    <!-- Header Link -->
                    <li class="hidden-xs animation-fadeInQuick">
                        <a href="javascript:void (0);"><strong>WELCOME</strong></a>
                    </li>
                    <!-- END Header Link -->
                </ul>
                <!-- END Left Header Navigation -->

                <!-- Right Header Navigation -->
                <ul class="nav navbar-nav-custom pull-right">
                    <!-- Search Form -->
                    <li>
                        <form action="{{ url("search") }}" method="post" class="navbar-form-custom">
                            <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
                        </form>
                    </li>
                    <!-- END Search Form -->

                    <!-- Alternative Sidebar Toggle Button -->
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');this.blur();">
                            <i class="gi gi-settings"></i>
                        </a>
                    </li>
                    <!-- END Alternative Sidebar Toggle Button -->

                    <!-- User Dropdown -->
                    {{------------------------------------用户栏⤵️-----------------------------------}}
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/img/placeholders/avatars/avatar9.jpg" alt="avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-header">
                                <strong>{{ Auth::check() ? Auth::user()->name  : "Not Login" }}</strong>
                            </li>

                            {{--<li>--}}
                            {{--<a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">--}}
                            {{--<i class="gi gi-settings fa-fw pull-right"></i>--}}
                            {{--Settings--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="page_ready_lock_screen.html">--}}
                            {{--<i class="gi gi-lock fa-fw pull-right"></i>--}}
                            {{--Lock Account--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            <li>
                                <form action="{{ url('/logout') }}" method="post" id="logout">
                                    {{ csrf_field() }}
                                </form>
                                <a href="#" onclick="$('#logout').submit();">
                                    <i class="fa fa-power-off fa-fw pull-right"></i>
                                    Log out
                                </a>

                            </li>
                        </ul>
                    </li>
                    {{------------------------------------用户栏⬆️️-----------------------------------}}
                    <!-- END User Dropdown -->
                </ul>
                <!-- END Right Header Navigation -->
            </header>
            <!-- END Header ------------------------------>

            <!-- Page content -->
            <div id="page-content">
                <!--成功提示信息-->
                @if(session('status') == 200)
                    <div class="col-sm-6 col-lg-12 " id="message">
                        <!-- Success Alert -->
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><strong>Success</strong></h4>
                            <p> {{ session('message') }} </p>
                        </div>
                        <!-- END Success Alert -->
                    </div>
                    <!--提示信息-->
                @elseif(session('status') == 201)
                    <div class="col-sm-6 col-lg-12 " id="message">
                        <!-- Info Alert -->
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><strong>Information</strong></h4>
                            <p> {{ session('message') }} </p>
                        </div>
                        <!-- END Info Alert -->
                    </div>
                    <!-- warning 提示信息-->
                @elseif(session('status') == 202)
                    <div class="col-sm-6 col-lg-12 " id="message">
                        <!-- Warning Alert -->
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><strong>Warning</strong></h4>
                            <p> {{ session('message') }} </p>
                        </div>
                        <!-- END Warning Alert -->
                    </div>
                    <!--错误信息-->
                @elseif(session('status') == 203)
                    <div class="col-sm-6 col-lg-12 " id="message">
                        <!-- Danger Alert -->
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><strong>Error</strong></h4>
                            <p> {{ session('message') }} </p>
                        </div>
                        <!-- END Danger Alert -->
                    </div>
                @endif


                @section("content")

                @show
            </div>
            <!-- END Page Content -->
        </div>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</div>
<!-- END Page Wrapper -->

<!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
<script src="{{ asset("/js/vendor/jquery-2.2.4.min.js") }}"></script>
<script src="{{ asset("/js/vendor/bootstrap.min.js") }}"></script>
<script src="{{ asset("/js/plugins.js") }}"></script>
<script src="{{ asset("/js/ui.app.js") }}"></script>
@section('bottom-style')

@show
@section('js')

@show
@section('script')

@show
        <!-- Load and execute javascript code used only in this page -->
<script src="{{ asset("/js/pages/readyDashboard.js") }}"></script>

<script>$(function(){ ReadyDashboard.init(); });
    //            $("#div2").fadeOut("slow");
    //            $("#message").fadeOut(5);
</script>
</body>
</html>