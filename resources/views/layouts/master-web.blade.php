<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Favicon icon **Sunny** -->
        <link rel="icon" href="{{ asset('reporter-blue.png') }}" type="image/png">
        <link rel="shortcut icon" href="{{ asset('reporter-blue.png') }}" type="image/png">
        <meta charset="utf-8">
        <?php
        $root = $_SERVER['HTTP_HOST'];
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Facebook/LinkedIn Share -->
        @yield('meta')
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
        </script>

        <link href="{{ asset('css/style/icons/font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
        <link href="{{ asset('css/chartist/chartist.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style/style.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('slick-1.8.1/slick/slick-theme.css') }}" />

        <link rel="stylesheet" type="text/css" href="{{ asset('css/jd-style.css') }}">
        <script src="{{ asset('js/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('slick-1.8.1/slick/slick.js') }}"></script>

        <title>Reporter</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary  w-hide" >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" style="width:250px;height:39px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse jd-navbar-header" id="navbarResponsive">
                    @if(isset($social_media) == true)
                    <ul class="navbar-nav mr-auto jd-navbar">
                        <li class="nav-item jd-navbar-menu-li1" >
                            <a class="nav-link" target="bank" href="{{ $social_media[0]->image  }}" style="padding-top:15px;" id="social-media-facebook">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li class="nav-item jd-navbar-menu-li2">
                            <a class="nav-link" target="bank"  href="{{ $social_media[1]->image }}" style="padding-top:15px;" id="social-media-twitter">
                            <i class="fab fa-twitter-square"></i>
                            </a>
                        </li>
                        <li class="nav-item jd-navbar-menu-li3">
                            <a class="nav-link" target="bank"  href="{{ $social_media[2]->image }}" style="padding-top:15px;" id="social-media-instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    @endif
                    <ul class="navbar-nav mr-auto" style="margin-top: 10px;">
                        @if(isset($active) == true)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if($active == 2 || $active == 3 || $active == 4 || $active == 5) active @else '' @endif"
                                href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Мэдээлэл
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item @if($active == 2) active @else '' @endif"
                                    href="{{ url('/post-page/2') }}">Кино</a>
                                <a class="dropdown-item @if($active == 3) active @else '' @endif"
                                    href="{{ url('/post-page/3') }}">Дуу хөгжим</a>
                                <a class="dropdown-item @if($active == 4) active @else '' @endif"
                                    href="{{ url('/post-page/4') }}">Драма</a>
                                <a class="dropdown-item @if($active == 5) active @else '' @endif"
                                    href="{{ url('/post-page/5') }}">Бусад</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($active == 1) active @else '' @endif"
                                href="{{ url('/post-page/1') }}">Бичлэг</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($active == 1) active @else '' @endif" href="{{ url('/contact-us') }}">Холбоо барих</a> 
                        </li>
                        <li class="jd-li1">
                            <form action="{{ url('/post-search') }}" method="GET" class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2 rounded-pill jd-search" name="post_search" type="text" placeholder="Хайх...">
                                <button class="btn btn-outline-light my-2 my-sm-0 btn_search  jd-btn" type="submit">Хайх</button>
                            </form>
                        </li>
                        @endif
                   </ul>
            </div>
        </div>
    </nav>
    @yield("content")
    <!-- Footer -->
    <div class="jumbotron bg-primary jumbotron-fluid" style="margin-top:10;padding:10px;margin-bottom:0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="grid-container py-2 px-3 mb-2 text-white">
                     <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" style="width:200px;height:29px;"></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="grid-container py-2 px-3 mb-2 text-white">
                        <div class="col-lg-1" style="margin-left:-15px;"><i class="ti-location-pin" style="font-size: 20px;float: left;padding-right:5px"></i>
                        </div><div class="col-lg-11" style="font-size:12px;margin-top:-10px;">  {{ $footer_information[0]->image }}</div>
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top:-10px;">
                    <div class="grid-container py-2 px-3 mb-2 text-white">
                    <div class="col-lg-3" style="margin-left:-12px;"><i class="ti-email" style="font-size: 20px;float:left;padding-right:5px"></i>
                        </div><div class="col-lg-9" style="font-size:12px;margin-left: 20px;">  {{ $footer_information[1]->image }}</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="grid-container py-2 px-3 text-white">
                         <p style="font-size:12px;">&copy; 2019-2020 , Зохиогчийн эрх хуулиар хамгаалагдсан. Мэдээлэл хуулбарлах хориотой. developed by AJU</p>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
@stack('scripts')
<script>
//Өргөны хэмжээ
function widthAuto(){
    var width = $(window).width();

    if (width < 768 || width < 992 ) {
        $(".w-hide").attr('style','height:auto;z-index: 1;');
    }else{
        $(".w-hide").attr('style','height: 130px;margin-top: 0px;z-index: 1;');
    }
}

$(document).ready(function(){
    //GET SCIAL MEDIA 
    var smf =  $('#social-media-facebook').attr('href');
    var smt =  $('#social-media-twitter').attr('href');
    var smi =  $('#social-media-instagram').attr('href');
    //SET SCIAL MEDIA
    $('#social-media-facebook').attr('href','http://www.'+smf);
    $('#social-media-twitter').attr('href','http://www.'+smt);
    $('#social-media-instagram').attr('href','http://www.'+smi);

    //Өргөны хэмжээ багасгах үед widthAuto1() функц тодорх үйлдэл хийгдэнэ
    $(window).resize(function() {
        widthAuto();
    });
    widthAuto();
});
</script>