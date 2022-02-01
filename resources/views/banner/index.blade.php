@extends('layouts.master')
@section('content')
<style>
.card-img-top{
    width:100px;
}

</style>
<!-- ALERT MESSAGE -->
<div id="success"></div>




<!-- <div class="input-group date"> -->
  <!-- <input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> -->
<!-- </div> -->
<!-- TABLE  -->
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="50%">
    <thead>
    <tr>
        <th>#</th>
        <th>Зураг</th>
        <th>Огноо</th>
        <th>Эхлэх</th>
        <th>Дууссах</th>
        <th>Засварлах</th>
    </tr>
    </thead>
    <tbody>
    @foreach($banners as $key => $item)
        <tr>
            <td>{{ $key+=1}}</td>
            <td> {!! $item->image !!}</td>
            <!-- FORMAT DATE -->
            <td>{{ Carbon\Carbon::parse($item->updated_at)->format('Y-m-d') }}</td>
            <td>{{ $item->start_date }}</td>
            <td>{{ $item->end_date }}</td>
            <td>
                <a href="#" 
                    class="btn btn-sm btn-success" 
                    data-toggle="modal" data-target="#slide-edit" onclick="slideView({{$item->id}})">
                    <i class="fa fa-pencil-square-o"></i> Update
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- View/Edit MODAL -->
<div class="modal" id="slide-edit" tabindex="-1" role="dialog" aria-labelledby="slide-modal">
    <div class="modal-dialog" role="document">
        <!-- <form method="POST" id="slide-update-form"> -->
        {!! Form::open(array('method' => 'put', 'id' => 'slide-update-form', 'files'=> true)) !!}
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="slide-modal">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="overflow:scroll;height:400px;">  
                    <label id="off-on">

                    </label>
                    <div class="form-group {{ $errors->has('link_image') ? 'has-error' : '' }}">
                        {!! Form::label('link_image', 'Link:', array('class' => 'control-label jd-bold')) !!}
                        <div class="controls">
                            {!! Form::text('link_image', null, array('class' => 'form-control','id' => 'link-image')) !!}
                            <span class="help-block text-danger" id="link-image-error"></span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        {!! Form::label('start_date', 'Start date:', array('class' => 'control-label jd-bold')) !!} 
                        <div class="controls">
                            <!-- <div class="input-group date"> -->
                            <div class="input-group date">
                                <input type="text" class="form-control" name="start_date" id="start-date"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>    
                            <!-- </div> -->
                            <span class="help-block text-danger" id="start-date-error"></span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        {!! Form::label('end_date', 'End date:', array('class' => 'control-label jd-bold')) !!}
                        <div class="controls">
                            <!-- <div class="input-group date2"> -->
                            <div class="input-group date">
                                <input type="text" class="form-control" name = "end_date" id="end-date"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>  
                            <!-- {!! Form::text('end_date', null, array('class' => 'form-control','id' => 'end-date')) !!} -->
                            <!-- </div> -->
                            <span class="help-block text-danger" id="end-date-error"></span>
                        </div>
                    </div>
                    <div id="slide-img"></div>
                    <h1></h1>
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        {!! Form::label('image', 'Файл оруулах:', array('class' => 'control-label jd-bold')) !!}
                        <div class="controls">
                            {!! Form::file('image', null, array('id'=>'image', 'class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('image', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="slide_id" id="slide-id" value="10">
                    <input type="hidden" name="img_link_img" id="img-link-img">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
                    <input type="submit" class="btn btn-primary" value="Хадгалах">
                </div>
            </div>
            {!! Form::close() !!}
        <!-- </form> -->
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    
    $('#slide-update-form').on('submit',function(event){
        //STOP RELOAD PAGE
        event.preventDefault();
        var id = $('#slide-id').val();
        //TOKEN KEY
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('banner') }}/"+id,
            method:'POST',
            dataType:'JSON',
            data: new FormData(this), //GET FORM DATA
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                //HIDE MODAL
                $('#slide-edit').modal('hide');
                //ALERT MESSAGE
                $('#success').html(
                        '<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">'+
                            data.success+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                            '</button>'+
                        '</div>'
                );
                //Alert hide хийх
                window.location.replace("{{ url('/') }}"+'/banner');
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                });
            },
            error: function(jqXhr, json, errorThrown){

                console.log(jqXhr.responseJSON);
                
                var errors = jqXhr.responseJSON;
                var errorsHtml = '';

                //Алдааны мэдээлэл дэлгэцэнд хэвлэх
                $("#link-image-error").text(errors.errors.link_image);
                $("#start-date-error").text(errors.errors.start_date);
                $("#end-date-error").text(errors.errors.end_date);

            }
        });
    });
});

// View Modal
function slideView(id){
    $('#off-on').text(' ');
    $('#slide-id').val(id);

    //$(function(){


        $('.input-group.date').datepicker({
            calendarWeeks: true,
            todayHighlight: true,
            autoclose: true
        });  
    //});

    $.ajax({
        
        url: "{{ url('/') }}"+'/banner/'+id,
        method:'GET',
        dataType:'JSON',
        
        success:function(data){

            if(data.system_code.id == 14 || data.system_code.id == 15 || data.system_code.id == 16){
                if(data.system_code.active == 1){
                    $('#off-on').html('<input id="chkToggle1" name="active" class="toggle" type="checkbox" value="1" checked> banner / on <-> off');
                }else{
                    $('#off-on').html('<input id="chkToggle1" name="active" class="toggle" type="checkbox" value="1"> banner / on <-> off');
                }
            }else{
                $('#off-on').html('');
            }

            $('#slide-title').val(data.system_code.id);
            $('#slide-img').html(data.system_code.image);
            $('#start-date').val(data.system_code.start_date);
            $('#end-date').val(data.system_code.end_date);

            var img_link = $('#slide-img a').attr('href').replace("http://", "");
            var img_link_img = $('#slide-img img').attr('src');

            $('#link-image').val(img_link);
            $('#img-link-img').val(img_link_img);
        },
    });
}
</script>

@endpush