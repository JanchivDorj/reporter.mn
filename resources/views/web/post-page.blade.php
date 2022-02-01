@extends("layouts.master-web")
@section("content")
<div class="container">
   <div class="row jd-row-m" >
        @foreach($post as $row)
        <a href="{{ url('/post-more/'.$row->id) }}">
        <img src="{{ url($row->title_img) }} " class="card-img-top jd-img hidden-sm-up" alt="..." style="width:100%;height:300px; object-fit: cover;">
        </a>
        <div class="col-md-3 jd-tb">
            <div class="card jd-card">
                <a href="{{ url('/post-more/'.$row->id) }}">
                <img src="{{ url($row->title_img) }}" class="card-img-top hidden-xs-down" alt="..." style="height:140px; object-fit: cover;">
                </a>
                <div class="card-body page_post">
                    <a href="{{ url('/post-more/'.$row->id) }}">
                    <h5 class="card-title" style="font-size:14px;color: black;">{{ $row->title }}</h5>
                    <h5 class="card-title" style="font-size:12px;color:#c9cfd0;">{{ $row->created_at }}</h5>
                    <p class="card-text" style="font-size:14px;color: black;">{!! $row->more_text !!}</p>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        @if($post->total() == 0)
        <p style="height:100%;"> <code> Бичлэг оруулаагүй байна </code></p>
        @endif
        
   </div>
   {{-- <div class="row w-25 p-3" style="margin-left:auto; margin-right:auto;"> --}}
    <div class="d-flex justify-content-center" style="margin-left:auto; margin-right:auto;">
        {{ $post->links() }}
   </div>
</div>
@endsection