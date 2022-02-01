@extends('layouts.master')
@section('content')
    {{-- @include('flash::message') --}}
    <div class="row">
    @foreach($categories as $key => $category)
      <div class="col-sm-12 col-lg-3">
         <div class="card card-hover">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div class="m-r-10">
                     <span>{!! $category->name !!}</span> 
                     <h4>{{ $category->category_count }}</h4>
                  </div>
                  <div class="ml-auto">
                     <span>Visit post</span>
                     <h4>{{ $posts[$key]['visit_post'] }}</h4>
                     <span>Total post</span>
                     <h4>{{ $posts[$key]['total_post'] }}</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
    @endforeach
   </div>
@endsection