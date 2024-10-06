@extends('layouts.auth')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:"><b>Stead</b> Fast</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Register to start your session</p>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}" placeholder="Name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-sm" placeholder="Password">
                <span class="pass-text">The password must be 8–16 characters, and include a number, a symbol, a lower and a upper case letter</span>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Confirm Password">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top: 10px;">Register</button>
        </form>

        <div class="text-center">
            <p style="margin: 10px 0;">- OR -</p>
            <a href="{{ route('login') }}">I already have a member.</a>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
@endsection
