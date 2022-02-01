@extends('layouts.master')
@section('content')
@include('flash::message')
<div class="col-sm-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Зураг </h4>
            <h6 class="card-subtitle"><code>Бичлэг зураг нэмэхдээ ( png,jpg )</code></h6>
            <div id="img-choosed"></div>
            <form method="post" id="slide-show-form">
                @csrf 
                @method('PUT')
                @php  $i = 0; $id = ''; @endphp
                <!-- 4 нь зураг давтах -->
                @foreach($slide_shows as $slide_show)
                    @php  $i++; $id .= $slide_show->id.','; @endphp
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div style="width:50px;height:50px;font-size:24px;padding:10px 15px;float:left;"> {{ $i }} </div>
                            <img class='card-img-top img-responsive img-thumbnail' src="{{ url($slide_show->image) }}" alt='Зураг байхгүй байна' style='width:100px;height:50px;object-fit: cover;'>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Файл оруулах {{ $i }}</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img_{{ $slide_show->id }}" id="img{{ $slide_show->id }}">
                                    <label class="custom-file-label" for="img{{ $slide_show->id }}" id = "img{{$i}}">Файл сонгох</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <input type="hidden" name="id_slide" id="id-slide" value="{{ $id }}">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" value="Хадгалах">
                </div>
            </form>
        </div>
    </div>
</div>   
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    //Файлын нэр хэвлэх
    $('.custom-file-input').on('change',function(){
        //Get index file
        var file_index = $('.custom-file-input').index(this);
        var file_name  = $(this).val(); //input-n file төрлөөс утгыг авах
        var file_orginal_name = file_name.split('\\')[2]; //зөвхөн нэршил авах

        $("#img"+(file_index+1)).text(file_orginal_name);//зураг хэвлэх
    });
    //зураг хадгалах
    $('#slide-show-form').on('submit',function(event){
        event.preventDefault();


        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id ='"'+$('#id-slide').val()+'"';
        $.ajax({
            url: "{{ url('/') }}"+"/slide-show/"+id,
            method:"POST",
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                location.reload();
                console.log(data);

            }
        });
    });
});
</script>
@endpush