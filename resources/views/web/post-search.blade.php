@extends("layouts.master-web")
@section("content")
<div class="container">
   <div class="row jd-contact-us">
        @foreach($post as $row)
        <div class="col-md-3">
            <div class="card" style="margin:5px;">
                <a href="{{ url('/post-more/'.$row->id) }}">
                     <img src="{{ url($row->title_img) }}" class="card-img-top" alt="..." style="height:140px;object-fit: cover;">
                </a>
                <div class="card-body">
                    <a href="{{ url('/post-more/'.$row->id) }}"><h5 class="card-title" style="font-size:12px;">{{ $row->title }}</h5></a>
                    <h5 class="card-title" style="font-size:12px;">{{ $row->created_at->format('Y-m-d') }}</h5>
                    <p class="card-text">{!! $row->more_text !!}</p>
                </div>
            </div>
        </div>
        @endforeach
        @if($post->total() == 0)
        <p style="height:100%;"> <code> Таны хайсан бичлэг байхгүй байна </code></p>
        @endif
   </div>
   <div class="row" style="margin-left:5px;">
        {{ $post->links() }}
   </div>
</div>
@endsection