@extends('layouts.error.main')
@section('content')
<div id="content" style="margin-top: 20px !important;margin-bottom: 0px !important;">
    <div class="m-grid__item m-grid__item--fluid m-grid  m-error-3">
        <div class="m-error_container">
            <span class="m-error_number">
                <h1>
                    Not active
                </h1>
            </span>
            <p class="m-error_title m--font-light">
                Chưa active tài khoản!
            </p>
            <p class="m-error_subtitle">
                <a href="{{route('home')}}" class="btn btn-sm btn-info">Trở về trang chủ</a>
            </p>
            <p class="m-error_title m--font-light">
                <a href="{{route('notactive')}}" type="button" class="btn btn-brand btn-sm m-btn m-btn--pill m-btn--wide">
                    <span class="fa fa-refresh"></span> Tải lại trang
                </a>
                <a href="{{ route('user.logout') }}" type="button" class="btn btn-danger btn-sm m-btn m-btn--pill m-btn--wide">
                    <span class="fa fa-sign-out"></span> Đăng xuất
                </a>
            </p>
        </div>
    </div>
</div>
@endsection