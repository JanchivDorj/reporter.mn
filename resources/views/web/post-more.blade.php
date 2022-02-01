@extends("layouts.master-web")
@section('meta')

    <?php
        //Одоо хандсан хуудасыг авах
        $root = $_SERVER['HTTP_HOST'];
    ?>

    <title>{{ $post->title }}</title>
    <!-- FACEBOOK SHARE POST -->
    <meta property="fb:app_id"        content="611506119390046" />
    <meta property="og:url"           content="http://reporter.mn/<?php echo $post_link; ?>" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="{{ $post->title }}" />
    <meta property="og:description"   content="{{ $post_description }}" />
    <meta property="og:image"         content="http://<?php echo $root.$post->title_img; ?>" />

@endsection
@section("content")
<style>
.card-img-top{
    width:100%;
}

jd::before {

    position: absolute;
    content: 'AD';
    padding: 9px;
    padding-top: 2px;
    width: 55px;
    font-weight: bold;
    color: white;
    height: 45px;
    font-size: 21px;
    /* background: #585757; */
    margin-top: 0px;
    z-index: 100;
    /* margin-left: 4px;*/
}

jd:after {
    background: #585757;
    height: 35px;
    width: 45px;
    opacity: 0.5;
    content: "\200c";
    position: absolute;
    left: 83px;
    z-index: 10;
}


jd1::before {

    position: absolute;
    content: 'AD';
    padding: 9px;
    padding-top: 2px;
    width: 55px;
    font-weight: bold;
    color: white;
    height: 45px;
    font-size: 21px;
    /* background: #585757; */
    margin-top: 0px;
    z-index: 100;
}

jd1:after {
background: #585757;
height: 35px;
width: 45px;
opacity: 0.5;
content: "\200c";
position: absolute;
left: 0;
z-index: 10;
}

jd .jd-banner{
    height:300px;
}
</style>
<div class="container">
   <div class="row jd-more-post">
      @if($post != null)
        <img src="{{ url($post->title_img) }} " class="card-img-top jd-img hidden-sm-up jd-post-more-img" alt="...">
        <div class="col-md-12">
            <div class="card jd-card">
                <img src="{{ url($post->title_img) }} " class="card-img-top jd-img hidden-xs-down" alt="..." style="width:100%">
                <div class="card-body">
                    <h5 class="card-title" style="font-size:17px;">{{ $post->title }}</h5>
                    <h5 class="card-title" style="font-size:12px;color:#c9cfd0;">{{ $post->created_at }}</h5>
                    <hr>
                    <p class="card-text">{!! $post->content !!}</p>
                </div>
            </div>
        </div>
        @else
        <p class="jd-post-more-p"> <code> Бичлэг оруулаагүй байна </code></p>
        @endif
   </div>
   <div class= "hidden-sm-up jd-post-more-title" >Reporter.mn NEWS ARTICLE</div>
   <div class = "row hidden-sm-up" style="padding: 20px;padding-top:10px">
        @foreach($posts as $key => $post)
            <div class="col-md-12 col-12 jd-post-more-col" >      
                <a href="{{ url('/post-more/'.$post->id) }}">
                    <img src="{{ asset($post->title_img) }}" alt="user" class="jd-post-more-col-img">
                    <h6 class="font-medium jd-post-more-col-h6">{!! str_limit($post->title,50) !!}</h6>
                    <span class="mb-3 d-block jd-post-more-col-span">{!! $post->more_text !!}</span>
                </a>
            </div>
            <!-- BANNER ADD ONLY PHONE-->
            @if($key == 4)
                @if($banner1->active == 1)
                <div class="col-md-12 col-12 jd-post-more-col" >      
                    {!! $banner1->image !!}
                </div>
                @endif
            @elseif($key == 9)
                @if($banner2->active == 1)
                <div class="col-md-12 col-12 jd-post-more-col" >      
                    {!! $banner2->image !!}
                </div>
                @endif
            @elseif($key == 14)
                @if($banner3->active == 1)
                <div class="col-md-12 col-12 jd-post-more-col" >      
                    {!! $banner3->image !!}
                </div>
                @endif
            @endif
        @endforeach
   </div>
</div>

<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

    <!-- <div class="fb-share-button" 
        data-href="http://reporter.mn/<?php //echo $post_link; ?>" 
        data-layout="button_count">
    </div> -->

@endsection
@push('scripts')
<script>
    
var url = window.location.href;
//Хуудасны хэмжээ багасгахад өргөны хэмжээг өөрчилөх
function widthAuto2(){
    var width = $(window).width();
    if (width < 768 || width < 992 ) {
        $('#video_title0').attr('width','100%');

    }else{
        $('#video_title0').attr('width','640px');
    }
}
$(document).ready(function(){

    $(window).resize(function() {
        widthAuto2();
    });
    widthAuto2();

});
</script>
@endpush
