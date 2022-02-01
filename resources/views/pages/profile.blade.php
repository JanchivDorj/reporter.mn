@extends('layouts.master')
@section('content')
<!-- ALERT MESSAGE -->
<div id="success"></div>
<!--CREATE FORM  -->
<form method="post" id="user-update-form">
    @csrf
    @method("PUT")
    <div class="col-md-6">
        <div class="form-group">
            <label for="last-name1" class="control-label">Овог:</label>
            <input type="text" class="form-control" name= "last_name" id="last-name">
            <div class="text-danger"><span id="error-last-name-edit"></span></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="first-name1" class="control-label">Нэр:</label>
            <input type="text" class="form-control" name="first_name" id="first-name">
            <div class="text-danger"><span id="error-first-name-edit"></span></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="control-label">И-мэйл:</label>
            <input type="text" class="form-control" name="email" id="email">
            <div class="text-danger"><span id="error-email-edit"></span></div>
        </div>
    </div>
    <input type="hidden" id="user-id" name="user_id">
    <input type="submit" class="btn btn-primary" value="Хадгалах">
</form>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    //EDIT PROFILE 
    $.ajax({

        url:'ajax-profile',
        method:'GET',
        data:{ user_id: '{{ $user_id }}' },

        success:function(data){

            $('#last-name').val(data.profile.last_name);
            $('#first-name').val(data.profile.first_name);
            $('#email').val(data.profile.email);

        }
    });
    //UPDATE PROFILE
    $('#user-update-form').on('submit',function(event){
        //STOP RELOAD PAGE
        event.preventDefault();
        //TOKEN KEY
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = '{{ $user_id }}';
        
        $.ajax({
            url: "{{ url('/') }}"+'/users/'+id, //LINKED
            method:'POST',
            data: new FormData(this), //GET FORM DATA
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                //ALERT MESSAGE
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