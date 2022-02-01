@extends('layouts.master-web')
@section("content")
<div class="project-carousel hidden-xs-down" id="proj-top">
    <div class="project-strip">
        @foreach($slide_shows as $slide_show)
           <div class="project"><img src="{{ url($slide_show->image) }}" style="height:590px;object-fit: cover;" alt=""/></div>
        @endforeach
    </div>
    <div class="project-screen">
        <div class="project-detail" style="width:960px; margin-left:30px">
            @foreach($slide_shows as $slide_show)
               <div class="project"><img src="{{ url($slide_show->image) }}" style="height:555px;object-fit:contain;" alt=""/></div>
            @endforeach
        </div>
        <div class="screen-frame"></div>
    </div>
</div>
<div class="container" >
    <div class="row p-4">
    <!-- Desktop -->
    <div class="col-md-6 col-lg-6 col-sm-12 hidden-xs-down">
        <div class="card shadow-sm">
            <div class="p-2" style="padding: 5px !important;">
                <div class="card-title border-left" style="border-left-width: 3px !important; padding-left:5px;margin: 15px;">
                     Мэдээлэл
                </div>
                <div class="comment-widgets">
                    <!-- Comment Row -->
                    @foreach($posts as $post)
                        <a href="{{ url('/post-more/'.$post->id) }}">
                            <div class="d-flex flex-row comment-row" style="margin-bottom: -16px !important;">
                                <div><img src="{{ asset($post->title_img) }}" alt="user"  style="width:140px;height: 100px;object-fit:cover;"></div>
                                <div class="comment-text w-100">
                                    <h6 class="font-medium" style="font-size: 17px;color: #000;">{!! str_limit($post->title,50) !!}</h6>
                                    <span class="mb-3 d-block" style="font-size: 12px;color: #000;">{!! $post->more_text !!}</span>
                                    <div class="comment-footer"></div>
                                </div>
                            </div>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>	
        </div>
    </div>    
    <!-- Desktop -->
    <div class="col-md-6 col-lg-6 col-sm-12 hidden-xs-down">
        <div class="card shadow-sm">
            <div class="p-2" style="padding: 5px !important;">
                <div class="card-title border-left" style="border-left-width: 3px !important; padding-left:5px;margin: 15px;">
                        Бичлэг
                </div>
                <div class="comment-widgets">
                    @php
                         $i = 1;
                    @endphp
                    <!-- Comment Row -->
                    @foreach($movies as $movie)
                    @if($i == 1)
                        <div id="video_title" style="margin-left: 11px;margin-right: 11px;">
                            <p id = "p_video" style="display:none;">{{ $movie->title_img }}</p>
                            <p id = "p_video1">{!! $movie->content !!}</p>
                        </div> 
                        <a href="{{ url('/post-more/'.$movie->id) }}">
                             <h6 class="card-title" style="margin-top:10px;font-size:17px;margin:25px;color:#000;">{{ str_limit($movie->title,50) }}</h6>
                        </a>     
                        <hr>         
                    @else
                        <a href="{{ url('/post-more/'.$movie->id) }}">
                            <div class="d-flex flex-row comment-row" style="margin-bottom: -16px !important;">
                                <div><img src="{{ asset($movie->title_img) }}" alt="user" style="width:140px;height: 100px;object-fit:cover;"></div>
                                <div class="comment-text w-100">
                                    <h6 class="font-medium" style="font-size:17px;color:#000;">{!! str_limit($movie->title,50) !!}</h6>
                                    <span class="mb-3 d-block" style="font-size:12px;color:#000;">{!! str_limit($movie->more_text,50) !!}</span>
                                    <div class="comment-footer"></div>
                                </div>
                            </div>
                        </a>
                        <hr>
                    @endif
                    @php $i++; @endphp
                    @endforeach
                </div>
            </div>	
        </div>
    </div>   
    <!-- Phone -->
    <div class="col-md-6 col-lg-6 col-sm-12 hidden-sm-up">
        <div class="card shadow-sm" style="margin-right: -33px;margin-left:-33px;">
            <div class="p-2" style="padding: 5px !important;">
                <div class="card-title border-left" style="border-left-width: 3px !important; padding-left:5px;margin: 15px;">
                     Мэдээлэл
                </div>
                <div class="comment-widgets">
                    <!-- Comment Row -->
                    @foreach($posts as $post)
                        <a href="{{ url('/post-more/'.$post->id) }}">
                            <div class="row" style="margin-bottom: -16px !important;">
                                <div class="col-md-12">
                                    <img src="{{ asset($post->title_img) }}" alt="user"  style="width:100%;height:300px;object-fit:cover;">
                                </div>
                                <div class="col-md-12 p-2">
                                <div class="comment-text w-100">
                                        <h6 class="font-medium" style="font-size: 17px;color: #000;">{!! str_limit($post->title,50) !!}</h6>
                                        <span class="mb-3 d-block" style="font-size: 12px;color: #000;">{!! $post->more_text !!}</span>
                                        <div class="comment-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>	
        </div>
    </div>    
    <!-- Phone -->
    <div class="col-md-6 col-lg-6 col-sm-12 hidden-sm-up">
        <div class="card shadow-sm" style="margin-right: -33px;margin-left:-33px;">
            <div class="p-2" style="padding: 5px !important;">
                <div class="card-title border-left" style="border-left-width: 3px !important; padding-left:5px;margin: 15px;">
                     Бичлэг
                </div>
                <div class="comment-widgets">
                @php
                        $i = 1;
                @endphp
                <!-- Comment Row -->
                @foreach($movies as $movie1)
                    @if($i == 1)
                    <div id="video_title1" style="margin-left: 11px;margin-right: 11px;">
                            <p id = "p_video1" style="display:none;">{{ $movie1->title_img }}</p>
                            <p id = "p_video2">{!! $movie1->content !!}</p>
                        </div> 
                        <a href="{{ url('/post-more/'.$movie->id) }}">
                             <h6 class="card-title" style="margin-top:10px;font-size:17px;margin:25px;color:#000;">{{ str_limit($movie1->title,50) }}</h6>
                        </a>     
                    <hr>                       
                    @else
                    <a href="{{ url('/post-more/'.$movie->id) }}">
                        <div class="row" style="margin-bottom: -16px !important;">
                            <div class="col-md-12">
                                <img src="{{ asset($movie1->title_img) }}" alt="user" style="width:100%;height:300px;object-fit:cover;">
                            </div>
                            <div class="col-md-12 p-2">
                                <div class="comment-text w-100">
                                    <h6 class="font-medium" style="font-size:17px;color:#000;">{!! str_limit($movie1->title,50) !!}</h6>
                                    <span class="mb-3 d-block" style="font-size:12px;color:#000;">{!! str_limit($movie1->more_text,50) !!}</span>
                                    <div class="comment-footer"></div>
                                </div>                            
                            </div>
                        </div>
                    </a>
                    <hr>  
                    @endif   
                    @php 
                      $i++;
                    @endphp           
                    @endforeach
                </div>
            </div>	
        </div>
    </div>  
    </div>
</div>
@endsection
@push('scripts')
<script>

function widthAuto1(){
    //Өргөны хэмжээ
    var width = $(window).width();
    if($("#video_title0").get() != ''){

         $('#video_title0').attr('width','540');
         $('#video_title0').attr('height','200');
         $('#video_title0').attr('style','margin-top:-10px;');

         var iframe_video = $('#video_title0').get();
         $(iframe_video).attr('style','width:100%');

         $('#video_title').html(".....");
         $('#video_title').html(iframe_video);

         pFirst = $('p:first').get();

    }else{

        var p_video = $('#p_video').text();
        $('#video_title').html('<img src="{{ asset("/") }}'+p_video+'" class="card-img" alt="..." style="margin-top: 10px;">');

    }    
    if(width < 598){
        $('#video_title1').html(iframe_video);
    }else

    if (width < 1199 ) {
        $('.project-detail').attr('style','width:760px; margin-left:125px');

    }else{
        $('.project-detail').attr('style','width:960px; margin-left:30px');
    }
}
$(document).ready(function(){
    //Өргөны хэмжээ багасгах үед widthAuto1() функц тодорх үйлдэл хийгдэнэ
    $(window).resize(function() {
        widthAuto1();
    });

    widthAuto1();
    //SLIDE (JQUERY )
    var slide = $('.slick-list .draggable').attr('style');

    $(".project-detail").slick({
        slidesToShow: 1,
        arrows: true,
        asNavFor: '.project-strip',
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $(".project-strip").slick({
        slidesToShow: 3,
        slidesToScroll: 2,
        variableWidth:true,
        arrows: false,
        asNavFor: '.project-detail',
        dots: false,
        infinite: true,
        centerMode: true,
        focusOnSelect: true,
    });
    // END SLIDE
});
</script>
@endpush



  