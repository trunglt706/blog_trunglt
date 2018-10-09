@extends('layouts.app')
@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
    </div>
    @include('layouts.auth.partials.notify')
    <!-- /.register-logo -->
    <div class="register-box-body">
        <p class="register-box-msg">Đăng ký tài khoản thành viên</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group has-feedback">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" placeholder="Nhập họ tên ..." class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" placeholder="Nhập email ..." class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" placeholder="Nhập mật khẩu ..." class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" placeholder="Nhập mật khẩu xác nhận ...." class="form-control" name="password_confirmation" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            {!! NoCaptcha::display() !!}<br/>
            <div class="form-group text-right"><button class="btn btn-primary" type="submit">{{ __('Register') }}</button></div>
        </form>
        <a href="{{route('login')}}"><i class="fa fa-sign-in"></i> Đã có tài khoản?</a>
    </div>
    <!-- /.register-box-body -->
</div>
<!-- /.register-box -->
@endsection
