<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon icon **Sunny** -->
    <link rel="icon" href="{{ asset('reporter-blue.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('reporter-blue.png') }}" type="image/png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" >

    <link href="{{ asset('css/chartist/chartist.min.css') }}" rel="stylesheet">
    {{-- Side Menu --}}
    <link href="{{ asset('css/style/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/summernote-bs4.css') }}" rel="stylesheet" >

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/jd-style.css') }}"> -->
    <script src="https://kit.fontawesome.com/a584f3f79a.js" crossorigin="anonymous"></script>


    <title>Reporter</title>

    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="{{ asset('js/picker/bootstrap-datepicker.min.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css"> -->





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
                             <span>
                                <img src="{{ asset('images/logo.png') }}" style="width:210px;height:29px;">
                             </span>
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>{{ $first_name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="{{ url('/ajax-profile') }}"><i class="ti-user m-r-5 m-l-5"></i> Хувийн мэдээлэл</a>
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="ti-wallet m-r-5 m-l-5"></i> Гарах</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <div class="user-profile d-flex no-block dropdown m-t-20">
                                <div class="user-pic">
                                    <!-- <img src="../../assets/images/users/1.jpg" alt="users" class="rounded-circle" width="40" /> -->
                                </div>
                                <div class="user-content hide-menu m-l-10">
                                    <a href="javascript:void(0)" class="" id="Userdd" role="button" aria-haspopup="true" aria-expanded="false">
                                        <h5 class="m-b-0 user-name font-medium">{{ $first_name }}</h5>
                                        <span class="op-5 user-email">{{ $role_name }}</span>
                                    </a>
                                </div>
                            </div>
                        </li>
                        @foreach($menus as $menu)
                            @if($menu->child_item == 2)
                            <li class="sidebar-item"> 
                                <a class="sidebar-link has-arrow waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false">
                                    <i class="mdi mdi-account-network"></i>
                                    <span class="hide-menu">{{ $menu->display_name }}</span>
                                </a>
                                <ul aria-expanded="false" class="collapse first-level">
                                    @foreach($items as $item)
                                        @if($item->child_item == $menu->id)
                                            <li class="sidebar-item">
                                                <a href="{{ url('/'.$item->url) }}" class="sidebar-link">
                                                    <i class="mdi mdi-octagram"></i>
                                                    <span class="hide-menu">{{ $item->display_name }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>  
                            @else
                            <li class="sidebar-item"> 
                                <a class="sidebar-link waves-effect waves-effect waves-dark sidebar-link" href="{{ url('/'.$menu->url) }}" aria-expanded="false">
                                    <i class="mdi {{ $menu->icon }}"></i>
                                    <span class="hide-menu">{{ $menu->display_name }}</span>
                                </a>
                            </li>                    
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">

            @include("tools.breadcrumb")

            @include('flash::message')

            <div class="container-fluid">
             @yield('content')   
            </div>

            <footer class="footer text-right">
                <div class="pull-right">
                    {{date('Y') .' '. 'developed by AJU'}}
                </div>
                <div class="clearfix"></div>
            </footer>
        </div>

    </div>

    <!-- Bootstrap -->

 
    <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js')}}"></script>
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
    <script src="{{ asset('dist/summernote-bs4.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.js"></script> 
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <!-- <script type='text/javascript' src='//code.jquery.com/jquery-1.8.3.js'></script> -->
    <script src="{{ asset('js/picker/bootstrap-datepicker.min.js') }}"></script>
    <!-- <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script> -->
    <!-- БУСАД ХУУДАСНЫ SCRIPT ОРЖ ИРНЭ -->
    @stack('scripts')
</body>

</html>