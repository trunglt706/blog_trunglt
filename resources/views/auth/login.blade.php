@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('admin.index')}}"><b>Admin</b>TrungLT</a>
    </div>
    @include('layouts.auth.partials.notify')
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Đăng nhập để quản lý dữu liệu</p>
        <form action="{{route('login-admin')}}" method="post">
            <div class="form-group has-feedback">
                @csrf
                <input type="email" class="form-control email" name="email" required placeholder="Nhập Email ...">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control password" name="password" required placeholder="Nhập mật khẩu ...">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{route('reset.password.admin')}}"><i class="fa fa-question-circle-o"></i> Quên mật khẩu?</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
