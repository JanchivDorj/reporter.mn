@extends('layouts.master')
@section('content')
<!-- ALERT MESSAGE -->
<div id="success"></div>
<!-- TABLE  -->
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="50%">
    <thead>
    <tr>
        <th>Гарчиг</th>
        <th>Зураг</th>
        <th>Огноо</th>
        <th>Засварлах</th>
    </tr>
    </thead>
    <tbody>
    @foreach($slide_shows as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td><img class='card-img-top img-responsive' src="{{ url('/') . $item->image }}" alt='No image' style='width:100px;'></td>
            <!-- FORMAT DATE -->
            <td>{{ Carbon\Carbon::parse($item->updated_at)->format('Y-m-d') }}</td>
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
        <form method="POST" id="slide-update-form">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="slide-modal">Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="overflow:scroll;height:400px;">                
                    <h5 class="card-title"> <span id="slide-title"></span></h5>
                    <img src="" class="card-img-top" alt="..." id="slide-img">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
                    <input type="submit" class="btn btn-primary" value="Хадгалах">
                </div>
            </div>
        </form>
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
            url: "{{ url('slide-show') }}/"+id,
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
                window.location.replace("{{ url('/') }}"+'/slide-show');
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                });
            }
        });
    });
});

// View Modal
function slideView(id){

    $('#slide-id').val(id);

    $.ajax({
        url: "{{ url('/') }}"+'/slide-show/'+id,
        method:'GET',
        dataType:'JSON',
        success:function(data){
            $('#slide-title').html(data.systemCode.id);
            $('#slide-img').attr('src', data.systemCode.image);
        }
    });
}
</script>
@endpush