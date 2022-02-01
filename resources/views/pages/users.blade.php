@extends('layouts.master')
@section('content')
<!-- ALERT MESSAGE -->
<div id="success"></div>
<!-- CREATE TABLE  -->
<div class="table-responsive">
    <!-- USER ADD BUTTON  -->
    <div align="right" style="margin:10px 0;">
         <button type="button" data-toggle="modal" data-target="#user-add"  class="btn waves-effect waves-light btn-success">Хэрэглэгч нэмэх</button>
    </div>
    <!-- TABLE CREATE (HTML)-->
    <table class="table table-striped table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Овог</th>
                <th>Нэр</th>
                <th>И-мэйл</th>
                <th>Үүрэг</th>
                <th>Засварлах</th>
            </tr>
        </thead>
    </table>
</div>
<!-- USERS ADD MODAL -->
<div class="modal" id="user-add" tabindex="-1" role="dialog" aria-labelledby="user-modal">
    <div class="modal-dialog" role="document">
        <form method="post" id="user-add-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="user-modal">Хэрэглэгч нэмэх</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="last-name" class="control-label">Овог:</label>
                        <input type="text" class="form-control" name= "last_name" id="last-name">
                        <div class="text-danger">
                            <span id="error-last-name"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first-name" class="control-label">Нэр:</label>
                        <input type="text" class="form-control" name="first_name" id="first-name">
                        <div class="text-danger">
                            <span id="error-first-name"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">И-мэйл:</label>
                        <input type="text" class="form-control" name="email" id="email">
                        <div class="text-danger">
                            <span id="error-email"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Нууц үг:</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <div class="text-danger">
                            <span id="error-password"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="same-password" class="control-label">Нууц үг дахин оруулах:</label>
                        <input type="password" class="form-control" name="same_password" id="same-password">
                        <div class="text-danger">
                            <span id="error-same-password"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="role1" value="admin">
                            <label class="form-check-label" for="role1">Админ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="role2" value="editor" checked>
                            <label class="form-check-label" for="role2">Нийтлэгч</label>
                        </div>
                        <div class="text-danger">
                            <span id="error-role"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
                    <input type="submit" class="btn btn-primary" value="Хадгалах">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- USERS EDIT MODAL -->
<div class="modal" id="user-edit" tabindex="-1" role="dialog" aria-labelledby="user-modal">
    <div class="modal-dialog" role="document">
        <form method="post" id="user-update-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="user-modal">Хэрэглэгч засах</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- TOKEN  -->
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="last-name1" class="control-label">Овог:</label>
                        <input type="text" class="form-control" name= "last_name" id="last-name1">
                        <div class="text-danger">
                            <span id="error-last-name-edit"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first-name1" class="control-label">Нэр:</label>
                        <input type="text" class="form-control" name="first_name" id="first-name1">
                        <div class="text-danger">
                            <span id="error-first-name-edit"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email1" class="control-label">И-мэйл:</label>
                        <input type="text" class="form-control" name="email" id="email1">
                        <div class="text-danger">
                            <span id="error-email-edit"></span>
                        </div>
                    </div>
                     <!-- HIDDEN VALUE -->
                    <input type="hidden" id="user-id" name="user_id">
                    <input type="hidden" id="password1" name="password">
                    <input type="hidden" id="same-password1" name="same_password">

                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div id="role_name"></div>
                        <div class="text-danger">
                            <span id="error-role-edit"></span></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
                    <input type="submit" class="btn btn-primary" value="Хадгалах">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- POST DELETE MODAL -->
<div class="modal" id="user-delete" tabindex="-1" role="dialog" aria-labelledby="user-modal">
    <div class="modal-dialog" role="document">
        <form method="post" id="user-delete-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="user-modal">Хэрэглэгч устгах</h4>
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
@endsection
@push('scripts')
<script>
//CREATE TABLE (JQUERY)
$(function() {
    $('#users-table').DataTable({
        processing: true, 
        serverSide: true,
        ajax: "{{  url('/users/create') }}", //Мэдээлэл авах холбоос
        columns: [ //Баганы мэдээлэл
            { data: 'id', name: 'id'},
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'email', name: 'email' },
            { data: 'name'},
            { data: 'action', name: 'action', orderable: false, searchable: false } //засах болон устгах товч
        ]
    });
});
//EDIT USER
function userEdit(id){
    // TOKEN (JQUERY) 
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //AJAX 
    $.ajax({
        url: "{{ url('/') }}"+'/users/'+id+'/edit', //Очих холбоос 
        method:'GET',
        dataType:'JSON',
        //SUCCESS INFORMATION
        success:function(data){
             //Дэлгэц руу хэрэглэгчийн мэдээлэл хэвлэх 
            $('#user-id').val(data.user.id);
            $('#first-name1').val(data.user.first_name);
            $("#last-name1").val(data.user.last_name);
            $("#email1").val(data.user.email);
            $("#password1").val(data.user.password);
            $("#same-password1").val(data.user.password);
            $("#role1").val(data.role.name);
            $('#role_name').text("");
            //Нийтлэгч болон Админ сонгох
            if(data.role.name == 'admin'){
                $('#role_name').html(
                '<div class="form-check form-check-inline">'+
                '<input class="form-check-input" type="radio" name="role" id="role1" value="admin" checked>'+
                '<label class="form-check-label" for="role1">Админ</label>'+
                '</div>'+
                '<div class="form-check form-check-inline">'+
                '<input class="form-check-input" type="radio" name="role" id="role2"  value="editor">'+
                '<label class="form-check-label" for="role2">Нийтлэгч</label>'+
                '</div>');
            }else{
                $('#role_name').html(
                '<div class="form-check form-check-inline">'+
                '<input class="form-check-input" type="radio" name="role" value="admin" id="role1">'+
                '<label class="form-check-label" for="role1">Админ</label>'+
                '</div>'+
                '<div class="form-check form-check-inline">'+
                '<input class="form-check-input" type="radio" name="role" value="editor" id="role2" checked>'+
                '<label class="form-check-label" for="role2">Нийтлэгч</label>'+
                '</div>');
            }
        }
    });
}
//DELETE USER
function userDelete(id){
    //form tag-с submit дархад
    $('#user-delete-form').on('submit',function(event){
        //Хуудас ачаалахыг зогсоох
        event.preventDefault();
        //TOKEN
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //AJAX
        $.ajax({
            url: "{{ url('/') }}"+'/users/'+id,
            method:'POST',
            data: new FormData(this), //input-н утга авах
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                $('#users-table').DataTable().ajax.reload(); //RELOAD TABLE 
                $('#user-delete').modal('hide'); //HIDE MODEL
                //ALERT MESSAGE
                $('#success').html(
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                        data.success+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'
                );
            }
        });
    });
}
//READY
$(document).ready(function(){
    // Мэдээлэл нэмэх
    $('#user-add-form').on('submit',function(event){

        event.preventDefault();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                                                                                                                                                        
        $.ajax({

            url: "{{ url('/users') }}",
            method:'POST',
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,

            success:function(data){

                $('#user-add-form')[0].reset();
                $('#users-table').DataTable().ajax.reload();
                $('#user-add').modal('hide');
                
                $('#success').html(
                '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                data.success+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
                '</div>'
                );
                //Алдааны талбарыг хоосон болгох
                $("#error-first-name").text("");
                $("#error-last-name").text("");
                $("#error-email").text("");
                $("#error-password").text("");
                $("#error-same-password").text("");
            },
            //Адааны мэдээлэл
            error: function(jqXhr, json, errorThrown){

                var errors = jqXhr.responseJSON;
                var errorsHtml = '';
                //Алдааны мэдээлэл дэлгэцэнд хэвлэх
                $("#error-first-name").text(errors.errors.first_name);
                $("#error-last-name").text(errors.errors.last_name);
                $("#error-email").text(errors.errors.email);
                $("#error-password").text(errors.errors.password);
                $("#error-same-password").text(errors.errors.same_password);
            }
        });
    });
    // UPDATE USER
    $('#user-update-form').on('submit',function(event){

        event.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $('#user-id').val();

        $.ajax({
            url: "{{ url('/') }}"+'/users/'+id,
            method:'POST',
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){

                $('#user-update-form')[0].reset();
                $('#users-table').DataTable().ajax.reload();
                $('#user-edit').modal('hide');

                $('#success').html(
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                        data.success+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'
                );

                //Алдааны мэдээлэл дэлгэцэнд хэвлэх
                $("#error-first-name-edit").text("");
                $("#error-last-name-edit").text("");
                $("#error-email-edit").text("");
                $("#error-password-edit").text("");
                $("#error-same-password-edit").text("");

            },

            error: function(jqXhr, json, errorThrown){

                var errors = jqXhr.responseJSON;
                var errorsHtml = '';

                //Алдааны мэдээлэл дэлгэцэнд хэвлэх
                $("#error-first-name-edit").text(errors.errors.first_name);
                $("#error-last-name-edit").text(errors.errors.last_name);
                $("#error-email-edit").text(errors.errors.email);
                $("#error-password-edit").text(errors.errors.password);
                $("#error-same-password-edit").text(errors.errors.same_password);

            }
        });
    });    
});




</script>
@endpush