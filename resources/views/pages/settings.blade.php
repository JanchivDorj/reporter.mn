@extends('layouts.master')
@section('content')
<!-- ALERT MESSAGE -->
<div id="success"></div>

<div class="card">
    <div class="card-header">
       Олон нийтийн сүлжээ 
    </div>
    <form id="setting-social-media">
        <div class="card-body">
             @csrf
             <input type = "hidden" name="social_media_id0" id="social-media-id0">
            <h4 class="card-title">Facebook </h4>
            <p class="card-text">
                 <input type="text" class="form-control" name="facebook" id="facebook">
                 <div class="text-danger"><span id="error-facebook"></span></div>
            </p>
            <input type = "hidden" name="social_media_id1" id="social-media-id1">
            <h4 class="card-title">Twitter </h4>
            <p class="card-text">
                 <input type="text" class="form-control" name="twitter" id="twitter">
                 <div class="text-danger"><span id="error-twitter"></span></div>
            </p>
            <input type = "hidden" name="social_media_id2" id="social-media-id2">
            <h4 class="card-title">Instagram </h4>
            <p class="card-text">
                 <input type="text" class="form-control" name="instagram" id="instagram">
                 <div class="text-danger"><span id="error-instagram"></span></div>
            </p>
            <button type="submit" class="btn waves-effect waves-light btn-success">Хадгалах</button>
        </div>
    </form>
</div>
<div id="success1"></div>
<div class="card">
    <div class="card-header">
    Вэб сайтны доод хэсгийн мэдээлэл
    </div>
    <form id="setting-footer-information">
        @csrf
        <div class="card-body">
            <input type="hidden" name ="footer_information_id0" id="footer-information-id0">
            <h4 class="card-title"> Address </h4>
            <p class="card-text">
                 <input type="text" class="form-control" name="address" id="address">
                 <div class="text-danger"><span id="error-footer-information0"></span></div>
            </p>
            <input type="hidden" name ="footer_information_id1" id="footer-information-id1">
            <h4 class="card-title">Email </h4>
            <p class="card-text">
                 <input type="text" class="form-control" name="email" id="email">
                 <div class="text-danger"><span id="error-email"></span></div>
            </p>
            <input type="hidden" name ="footer_information_id2" id="footer-information-id2">
            <h4 class="card-title">Send Email </h4>
            <p class="card-text">
                 <input type="text" class="form-control" name="send_email" id="send_email">
                 <div class="text-danger"><span id="error-send-email"></span></div>
            </p>
            <button type="submit" class="btn waves-effect waves-light btn-success">Хадгалах</button>
        </div>
    <form>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    //View Social media
    $.ajax({
        url:'{{ url("/ajax-social-media") }}', //LINKED
        method:'GET',
        dataType:'JSON',
        success:function(data){
            var name = ['facebook','twitter','instagram'];
            data.social_media.forEach((i,n) => {
                $('#social-media-id'+n).val(i.id);
                $('#'+name[n]).val(i.image);
            });
        }
    });
    //Add Social media
    $('#setting-social-media').on('submit',function(event){
        event.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("content")
            }
        });

        $.ajax({
            url:'{{ url("/ajax-social-media") }}',
            method:'POST',
            dataType:'JSON',
            data: new FormData( this ),
            cache:false,
            processData:false,
            contentType:false,

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
                //FORM RESET INPUT VALUE
                $("#error-facebook").text("");
                $("#error-twitter").text("");
                $("#error-instagram").text("");

            },

            error:function(jqXhr, json, errorThrown){

                var errors = jqXhr.responseJSON;

                $("#error-facebook").text(errors.errors.facebook);
                $("#error-twitter").text(errors.errors.twitter);
                $("#error-instagram").text(errors.errors.instagram);
            }
        });
    });
    //View footer information
    $.ajax({
        url: '{{ asset("/ajax-footer-information") }}',
        method:'GET',
        dataType: 'JSON',
        success:function(data){
            var name = ['address','email','send_email'];
            data.footer_information.forEach((i,n) => {
                $('#footer-information-id'+n).val(i.id);
                $('#'+name[n]).val(i.image);
            })
        }
    });
    //Add footer information
    $("#setting-footer-information").on('submit',function(event){
         
        event.preventDefault();

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr("content")
            }
        });

        $.ajax({

            url: '{{ url("/ajax-footer-information") }}',
            method:'POST',
            dataType:'JSON',
            data: new FormData( this ),
            cache:false,
            processData:false,
            contentType:false,

            success:function(data){
                //ALERT MESSAGE
                $('#success1').html(
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                        data.success+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'
                );

                //FORM RESET INPUT VALUE
                $("#error-address").text("");
                $("#error-email").text("");
                $("#error-send-email").text("");

            },
            error:function(jqXhr, json, errorThrown){

                var errors = jqXhr.responseJSON;

                $("#error-address").text(errors.errors.address);
                $("#error-email").text(errors.errors.email);
                $("#error-send-email").text(errors.errors.send_email);
            }
        });
    });
});
</script>
@endpush