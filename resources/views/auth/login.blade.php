@extends('layouts.master-auth')
<style>
.invalid-feedback {
    display: block !important;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #f62d51 !important;
}
</style>
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Нэвтрэх</h4>
                <h6 class="card-subtitle invalid-feedback"> 
                    @include('flash::message')
                </h6>
                <form class="mt-4" action="{{ url('/login') }}" method="post">
                     @csrf
                    <div class="form-group">
                        <label for="user-name">Хэрэглэгчийн нэр</label>
                        <input type="text" class="form-control" name="user_name" id="user-name" aria-describedby="user-name" value="{{ old('user_name') }}" placeholder="Хэрэглэгчийн нэр">
                        <small id="user_name" class="form-text invalid-feedback">@error('user_name') {{$message}} @enderror</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Нууц үг</label>
                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Нууц үг">
                        <small id="password" class="form-text invalid-feedback">@error('password') {{$message}} @enderror</small>
                    </div>
                    <div class="custom-control custom-checkbox mr-sm-2 mb-3">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" value="check">
                        <label class="custom-control-label" for="remember">Сануулах</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Нэвтрэх</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection