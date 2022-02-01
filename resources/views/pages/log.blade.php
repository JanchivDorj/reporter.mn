@extends('layouts.master')
@section('content')
<!-- ALERT MESSAGE -->
<div id="success"></div>
<!-- CREATE LOG TABLE  -->
<div class="table-responsive">
    <!-- TABLE CREATE -->
    <table class="table table-striped table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Огноо</th>
                <th >Төрөл</th>
                <th>Тайлбар</th>
                <th>IP</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{  url('/ajax-log') }}",
        columns: [
            { data: 'date', name: 'date' },
            { data: 'type', name: 'type' },
            { data: 'description', name: 'description' },
            { data: 'ip', name: 'ip' },
        ]
    });
});
</script>
@endpush