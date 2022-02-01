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
@section('linked')
<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="{{ url('login') }}">
    <!-- <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"> -->
    <span>Нэвтрэх</span>
</a>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Бүртгүүлэх</h4>
                <form class="mt-4" action="{{ url('/register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="last-name">Овог</label>
                        <input type="text" class="form-control"  name="last_name" value="{{ old('last_name') }}" id="last-name" aria-describedby="last-name" placeholder="Овог ...">
                        <small id="last-name" class="form-text invalid-feedback">
                            @error('last_name') {{ $message }} @enderror
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="first-name">Нэр</label>
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="first-name" aria-describedby="first-name" placeholder="Нэр ...">
                        <small id="first-name" class="form-text invalid-feedback">
                           @error('first_name') {{ $message }} @enderror
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="email">И-мэйл</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email" aria-describedby="email" placeholder="И-мэйл ...">
                        <small id="email" class="form-text invalid-feedback">
                           @error('email') {{ $message }} @enderror
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="password">Нууц үг</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Нууц үг">
                        <small id="password" class="form-text invalid-feedback">
                           @error('password') {{ $message }} @enderror
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="same-password">Нууц үг ээ дахин оруулах</label>
                        <input type="password" class="form-control" name="same_password" value="{{ old('same_password') }}" id="same-password" placeholder="Нууц үг">
                        <small id="same-password" class="form-text invalid-feedback">
                           @error('same_password') {{ $message }} @enderror
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection