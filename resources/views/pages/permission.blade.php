@extends('layouts.master')
@section('content')
<!-- ALERT MESSAGE -->
<div id="success"></div>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Үүрэг</h4>
                <h6 class="card-subtitle">
                    <code>Үүрэг сонгоход хамааралтай хуудаснууд гарч ирнэ</code>
                </h6>
                <form>
                    <select multiple="" class="form-control" id="exampleFormControlSelect2">
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->slug }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Хуудаснууд</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card1"></div>
                    </div>
                    <div class="col-md-6">
                       <div class="items"></div>
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
    //CHOOSE SELECT OPTION
    $( "select" ).change(function () {
            
        var str = "";
        //Admin эсвэл Editor сонгоход
        $( "select option:selected" ).each(function() {
            //Үүрэгийн ID-г id varaible руу оноох
            var id = $( this ).val();
            var dis = 'disabled'; //Идэвхгүй болгох

            $.ajax({
                //
                url: "{{ url('/') }}"+'/permission/'+id, //Холбоос
                method:'GET',
                dataType:'JSON',

                success:function(data){

                    var result = "<form id='permission-form-update'>";

                    data.permissions.forEach((i,n) => {
                        //User болон Permission цэс идэвхгүй болгох
                        if(i.url == 'permission' || i.child_item == 2){

                            dis = 'disabled';

                        }else{

                            dis = '';

                        }
                        // Цэсны  child_item  3 тэнцүү үед дэлгэцэнд хэвлэхгүй байх
                        if(i.child_item == 3){

                            result +="";

                        }else 
                        //child_item 0 , 2 байвал үндсэн цэс
                        if(i.child_item == 0 || i.child_item == 2){

                            //Идэвхтэй болон идэвхгүй байдалыг тодорхойлох
                            if(i.active == 1 ){
                                result += "<fieldset class='checkbox'><label><input type='checkbox' name='active_page"+i.id+"' id='active-page"+i.id+"' value='"+i.active+"' "+dis+" checked> "+i.display_name+" </label></fieldset>";
                            }else{
                                result += "<fieldset class='checkbox'><label><input type='checkbox' name='active_page"+i.id+"' id='active-page"+i.id+"' value='"+i.active+"' "+dis+"> "+i.display_name+" </label></fieldset>";
                            }

                        }
                        //child_item бусад ID байвал цэсны доторх submenu болно
                        else{
                            //Идэвхтэй болон идэвхгүй байдалыг тодорхойлох
                            if(i.active == 1 ){
                                result += "<fieldset class='checkbox'><label style='margin-left:15px;'><input type='checkbox' name='active_page"+i.id+"' id='active-page"+i.id+"' value='"+i.active+"'  "+dis+" checked> "+i.display_name+" </label></fieldset>";
                            }else{
                                result += "<fieldset class='checkbox'><label style='margin-left:15px;'><input type='checkbox' name='active_page"+i.id+"' id='active-page"+i.id+"' value='"+i.active+"' "+dis+"> "+i.display_name+" </label></fieldset>";
                            }

                        }
                        result += '<input type="hidden" name="permission_id" id="permission-id'+i.id+'" value='+i.id+'>';
                    });

                    result += '</form>';
                    //HTML card1 class руу хэвлэх
                    $('.card1').html(result);
                    //check and uncheck
                    data.permissions.forEach((i,n) => {

                        var id = $("#permission-id"+i.id).val();
                        var active_page = $("#active-page"+i.id).val();

                        $('#active-page'+i.id).change(function() {

                            //Сонгосон цэсыг идэвтэй болгоод хадгалах
                            if($(this).is(":checked")) {

                                $.ajaxSetup({
                                    headers:{
                                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url: "{{ asset('/') }}"+"ajax-permission-active",
                                    method:'POST',
                                    dataType:'JSON',
                                    data: {
                                        'active_page': 1,
                                        'id':id
                                    },
                                    success:function(data){
                                        $("#success").html("");
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
                            }
                            //Сонгоогүй цэсыг идэвхгүй болгоод хадгалах
                            else{
                                $.ajaxSetup({
                                    headers:{
                                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url: "{{ asset('/') }}"+"ajax-permission-active",
                                    method:'POST',
                                    dataType:'JSON',
                                    data: {
                                        'active_page': 0,
                                        'id':id
                                    },
                                    success:function(data){
                                        $("#success").html("");
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
                            }    
                        });
                    });
                }
            });
        });
    });
});
</script>
@endpush