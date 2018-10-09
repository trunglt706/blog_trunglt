@extends('layouts.app')
@section('content')
<div class="login-box">
    @include('layouts.auth.partials.notify')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg text-center">
            <span class="fa fa-4x fa-user-secret"></span>
        </p>
        <form action="{{route('login.admin.post')}}" method="post">
            <div class="form-group has-feedback">
                @csrf
                <input type="email" class="form-control email" name="email" required placeholder="Nhập Email ...">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control password" name="password" required placeholder="Nhập mật khẩu ...">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
            </div>
        </form>

        <a href="{{route('reset.password.admin')}}"><i class="fa fa-question-circle-o"></i> Quên mật khẩu?</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
