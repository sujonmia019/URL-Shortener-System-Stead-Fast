@extends('layouts.auth')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="fa fa-envelope form-control-feedback"></span>
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group has-feedback">
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="fa fa-unlock-alt form-control-feedback"></span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="form-checkbox">
                        <input type="checkbox" class="form-check-input" id="remember-me">
                        <label class="form-check-label" for="remember-me">Remember Me</label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <a href="#" style="display: block;text-align:right;">I forgot my password</a>
                </div>
                <!-- /.col -->
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top: 10px;">Sign In</button>
        </form>



    </div>
    <!-- /.login-box-body -->
</div>
@endsection
