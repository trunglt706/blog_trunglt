@extends('layouts.error.main')
@section('content')
<div id="content" style="margin-top: 20px !important;margin-bottom: 0px !important;">
    <div class="m-grid__item m-grid__item--fluid m-grid  m-error-3">
        <div class="m-error_container">
            <span class="m-error_number">
                <h1>
                    500
                </h1>
            </span>
            <p class="m-error_title m--font-light">
                Internal Server Error
            </p>
            <p class="m-error_subtitle">
                <a href="{{route('home')}}" class="btn btn-sm btn-info">Trở về trang chủ</a>
            </p>
        </div>
    </div>
</div>
@endsection