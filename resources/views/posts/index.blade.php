@extends('layouts.master')
@section('content')
<!-- ALERT MESSAGE -->
<div id="success"></div>

<div class="table-responsive">
    <!-- ADD BUTTON -->
    <div align="right" style="margin:10px 0;">
        <a href="{{ url('/post/post-add') }}">
            <button type="button" class="btn waves-effect waves-light btn-success">Бичлэг нэмэх</button>
        </a>
    </div>
    <!-- TABLE CREATE -->
    <table class="table table-striped table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Төрөл</th>
                <th>Харсан</th>
                <th>Гарчиг</th>
                <th>Зураг</th>
                <th>Агуулга</th>
                <th>Огноо</th>
                <th>Засварлах</th>
            </tr>
        </thead>
    </table>
</div>
<!-- POST DELETE MODAL -->
<div class="modal" id="post-delete" tabindex="-1" role="dialog" aria-labelledby="post-modal">

    <div class="modal-dialog" role="document">

        <form method="post" id="post-delete-form">

            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="post-modal">Бичлэг устгах</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    Устгахдаа итгэлттэй байна уу ?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
                    <input type="hidden" id="action" value="delete">
                    <input type="submit" class="btn btn-danger" value="Устгах">
                </div>
            </div>
        </form>

    </div>
</div>

<!-- POST VIEW MODAL -->
<div class="modal " id="post-view" tabindex="-1" role="dialog" aria-labelledby="post-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="post-modal">Бичлэг харах</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow:scroll;height:400px;">
                <div class="container">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-12">
                            <div class="card" style="margin:5px;">
                                <div class="card-body">
                                    <h5 class="card-title"> <span id="post-title"></span></h5>
                                    <img src="" class="card-img-top" alt="..." id="post-img">
                                    <p class="card-text"> <span id="post-content"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    //CREATE TABLE (JQUERY)
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{  url('/post/data') }}",
        order: [[ 4, 'desc' ]], 
        columns: [
            { data: 'type', name: 'type' },
            { data: 'count_post',name: 'count_post'},
            { data: 'title', name: 'title' },
            { data: 'title_img', name: 'title_img' ,
                render: function(data,type,full,meta){
                    return "<img class='card-img-top img-responsive' src='{{ url('/') }}"+data+"' alt='Card image cap' style='width:100px;height:80px;object-fit: cover;'>";
                },
                orderable: false, 
                searchable: false
            },
            { 
                data: 'content',
                name: 'content',
                orderable: false, 
                searchable: false
            },
            { 
                data: 'date', 
                name: 'date',
                orderable: false, 
                searchable: false
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            }
        ]
    });
});

// Post View Modal : /post/$id
function postView(id){
    $.ajax({
        url: "{{ url('/') }}"+'/post/'+id,
        method:'GET',
        dataType:'JSON',
        success:function(data){
            $('#post-img').attr('src',data.post.title_img);
            $('#post-title').html(data.post.title);
            $('#post-content').html(data.post.content);
        }
    });
}
// Post Delete Modal
function postDelete(id){
    $('#post-delete-form').on('submit',function(event){
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('/') }}"+'/post/'+id,
            method:'POST',
            dataType:'JSON',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){

                $('#users-table').DataTable().ajax.reload();
                $('#post-delete').modal('hide');
                $('#success').html(
                        '<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">'+
                            data.success+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span>'+
                            '</button>'+
                        '</div>'
                );
                //Alert hide хийх
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500);
                });
            }
        });
    });
}
</script>
@endpush