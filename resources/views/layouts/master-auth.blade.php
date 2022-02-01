<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="csrf_token()">
    <title>Reporter</title>
    <!-- Favicon icon **Sunny** -->
    <link rel="icon" href="{{ asset('reporter-blue.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('reporter-blue.png') }}" type="image/png">
    <!-- Custom CSS -->
    <link href="{{ asset('css/chartist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/icons/font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{ url('/login') }}">
                        <!-- Logo icon -->
                        <b class="logo-icon"></b>
                        <span class="logo-text">
                             <span><img src="{{ asset('images/logo.png') }}" style="width:210px;height:29px;"></span>
                        </span>
                    </a>
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <!-- left menu -->
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            @yield('linked')
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> Profile</a>
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="ti-wallet m-r-5 m-l-5"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container mx-auto">
            @yield('content')   
        </div>
    </div>
    <!-- All Jquery -->
    <script src="{{ asset('js/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/js-style/app-style-switcher.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/js-style/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/js-style/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/js-style/custom.js') }}"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{ asset('js/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('js/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- <script src="{{ asset('js/pages/dashboards/dashboard1.js') }}"></script> -->
</body>

</html>