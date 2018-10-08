@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('admin.index')}}"><b>Admin</b>TrungLT</a>
    </div>
    @include('layouts.auth.partials.notify')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Reset mật khẩu</p>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.email.reset') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Nhập email ..." name="email" value="{{ old('email') }}" required>
                <input name="author" value="{{$author}}" class="hidden"/>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div><br/>
            <div class="form-group text-center">
                <i class="fa fa-sign-in"></i> Trở về trang <a href="{{route('login')}}">đăng nhập</a>
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection