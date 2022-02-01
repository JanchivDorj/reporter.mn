@extends('layouts.master')
@section('content')
<style>
.jd-back-btn{
    margin-left: 10px;
    margin-top: -5px;
    padding: 2px;
    padding-left: 10px;
    padding-right: 10px;
    font-size: 12px;
}
.jd-bold{
    font-weight:bold;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            {!! Form::model($post, array('url' => url('post') . '/' . $post->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}

                <input type="hidden" name="post-id" id="post-id" value="{{ $post->id }}">

                <div class="card-body">

                    <h4 class="card-title">Бичлэг засах <a href="{{ url('/post') }}"><button type="button" class="btn btn-primary jd-back-btn">Буцах</button></a></h4>
                    <div id="success"></div>
                    <br />
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        {!! Form::label('title', 'Гарчиг:', array('class' => 'control-label jd-bold required')) !!}
                        <div class="controls">
                            {!! Form::text('title', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                        <div class="controls">
                            {!! Form::textarea('content', null, array('class' => 'form-control', 'id' => 'content')) !!}
                            <span class="help-block">{{ $errors->first('content', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label jd-bold">Бичлэг сонгох:</label>
                        <br />
                            @if($post->post_img == 1)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img1" value="1" checked>
                                    <label class="form-check-label" for="post-img1">Бичлэг</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img1" value="1">
                                    <label class="form-check-label" for="post-img1">Бичлэг</label>
                                </div>
                            @endif
                            @if($post->post_img == 2)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img2" value="2" checked>
                                    <label class="form-check-label" for="post-img2">Кино</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img2" value="2">
                                    <label class="form-check-label" for="post-img2">Кино</label>
                                </div>
                            @endif
                            @if($post->post_img == 3)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img3" value="3" checked>
                                    <label class="form-check-label" for="post-img3">Дуу хөгжим</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img3" value="3">
                                    <label class="form-check-label" for="post-img3">Дуу хөгжим</label>
                                </div>
                            @endif
                            @if($post->post_img == 4)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img4" value="4" checked>
                                    <label class="form-check-label" for="post-img4">Драма</label>
                                </div>  
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img4" value="4">
                                    <label class="form-check-label" for="post-img4">Драма</label>
                                </div>
                            @endif
                            @if($post->post_img == 5)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img5" value="5" checked>
                                    <label class="form-check-label" for="post-img5">Бусад</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="post_img" id="post-img5" value="5">
                                    <label class="form-check-label" for="post-img5">Бусад</label>
                                </div>
                            @endif
                        <div class="text-danger"><span id="error-post-img"></span></div>  
                    </div>
                    <div class="form-group">
                        @if(isset($post->title_img))
                            <div>
                                {{-- <img src="{{ url($post->title_img) }}" style="width:300px;height:150px;"> --}}
                                <img src="{{ url($post->title_img) }}" style="width:300px;height:150px;object-fit: cover;">
                            </div>
                        @endif
                        <label for="title" class="control-label jd-bold">Файл оруулах:</label>
                        <div class="custom-file">
                            <input type="hidden" name="post_img_edit" value="{{$post->title_img}}">
                            <input type="file" class="custom-file-input" name="image" id="image" value="{{ $post->title_img }}">
                            <label class="custom-file-label" for="image">{{ $post->title_img }}</label>
                        </div>
                        <div class="text-danger"><span id="error-image"></span></div>
                    </div>  
                    <input type="submit" class="btn btn-primary" value="Хадгалах">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- INSERT IMAGE AND URL BUTTON-->
<div class="modal" id="slide-edit" tabindex="-1" role="dialog" aria-labelledby="slide-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  method="get" id="image">
                <div class="modal-header">
                    <h4 class="modal-title" id="slide-modal">Insert Image URL</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow:scroll;height:200px;"> 
                    <div class="image-error text-danger"></div>               
                    <div class="form-group note-form-group note-group-select-from-files">
                        <label class="note-form-label">Select from files</label>
                        <input class="note-image-input form-control-file note-form-control note-input" id="image-upload" onchange ="showPreview(this)" type="file" name="files" accept="image/*" multiple="multiple">
                    </div>
                    <div class="form-group note-group-image-url" style="overflow:auto;">
                        <label class="note-form-label">Image add URL</label>
                        <input class="note-image-url form-control note-form-control note-input  col-md-12" id="image-url" type="text">
                    </div>             
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
var input_file = "";
//CHOOSE IMAGE
function showPreview(obj_file_input){
    var el1 = $('#content').summernote('editor.restoreRange');

    if(obj_file_input.files[0] && $('#image-url').val() != ''){
        var file_reader = new FileReader();
        file_reader.onload = function (e){
            input_file = e.target.result;

            $('#content').summernote('pasteHTML','<a target="_blank" href="http://'+$('#image-url').val()+'"><img src="'+input_file+'"></a>');
            $('#image-url').val("");
            $('#image-upload').val("");
            $('#slide-edit').modal('hide');
            $('.image-error').text(" ");
        }

        file_reader.readAsDataURL(obj_file_input.files[0]);
    }else{

        $('#image-url').val("");
        $('#image-upload').val("");
        $('.image-error').text("Required image and url");

    }

}

//ADD CUSTOM BUTTON ON SUMMERNOTE
var getImgURL = function (context) {
  var ui = $.summernote.ui;
  // create button
  var button = ui.button({
    contents: '<i class="note-icon-picture"/> URL',
    tooltip: 'Image URL',
    click: function () {

      $('#slide-edit').modal('hide');
      $('#slide-edit').modal('show');

    }
  });
  return button.render();
}


//ADD CUSTOM BUTTON ON SUMMERNOTE
var getBanner1 = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="note-icon-picture"/> Banner 1',
    tooltip: 'Banner 1 URL',
    click: function () {
        // context.invoke('editor', '[--BANNER 1--]');
        $('#content').summernote('editor.insertText', '[--BANNER 1--]');
    }
  });

  return button.render();
}
//ADD CUSTOM BUTTON ON SUMMERNOTE
var getBanner2 = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="note-icon-picture"/> Banner 2',
    tooltip: 'Banner 2 URL',
    click: function () {
        // context.invoke('editor', '[--BANNER 1--]');
        $('#content').summernote('editor.insertText', '[--BANNER 2--]');
    }
  });

  return button.render();
}
//ADD CUSTOM BUTTON ON SUMMERNOTE
var getBanner3 = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="note-icon-picture"/> Banner 3',
    tooltip: 'Banner 3 URL',
    click: function () {
        // context.invoke('editor', '[--BANNER 1--]');
        $('#content').summernote('editor.insertText', '[--BANNER 3--]');
    }
  });

  return button.render();
}

$(document).ready(function(){
     //CHOOSE FILE NAME
    $('.custom-file-input').on('change',function(){
        var file_name = $(this).val();
        var file_name_orginal = file_name.split('\\')[2];
        $('.custom-file-label').text(file_name_orginal);
    });
    
    //Editor add button
    $('textarea').summernote({
        placeholder: 'Мэдээлэл байхгүй байна',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['picture'],
            ['table'],
            ['video'],
            ['link'],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['mybutton', ['imgURL']],
            ['btn1', ['btn1']],
            ['btn2', ['btn2']],
            ['btn3', ['btn3']],           
        ],
        buttons: {
            imgURL: getImgURL,
            btn1: getBanner1,
            btn2: getBanner2,
            btn3: getBanner3,
        }
    });
});
</script>
@endpush