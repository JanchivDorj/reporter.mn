@extends("layouts.master-web")
@section("content")
<div class="container">
    <div class="row jd-contact-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    @include('flash::message')
                    <form action = "{{ url('mail-send') }}" method="GET">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Contact us</h4>
                                <div class="form-group mt-5">
                                    <label>Name <small class="text-muted"></small></label>
                                    <input type="text" name ="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email <small class="text-muted"></small></label>
                                    <input type="email" name ="email" class="form-control" required> 
                                </div>
                                <div class="form-group">
                                    <label>Subject <small class="text-muted"></small></label>
                                    <input type="text" name ="subject" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Message <small class="text-muted"></small></label>
                                    <textarea type="text" name = "message" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Send">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    //Alert hide хийх
    $("#success-alert").fadeTo(1000, 500).slideUp(500, function() {
        $("#success-alert").slideUp(500);
    });
});
</script>
@endpush