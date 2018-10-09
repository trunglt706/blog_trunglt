@if(auth()->user()->status != -1)
@extends('layouts.user.main')
@section('content')
@if(auth()->user()->status == 1)
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TỔNG QUAN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('user.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tổng quan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$object['tong']}}</h3>
                        <p>Tổng số bài viết</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$object['da_duyet']}}</h3>
                        <p>Bài viết đã duyệt</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$object['cho_duyet']}}</h3>
                        <p>Bài viết chờ duyệt</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-comment-o"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$object['block']}}</h3>
                        <p>Bài viết đang khóa</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-envelope-open-o"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        @include('user.notify')
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@else
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="well bg-green">
                <span class="fa fa-info-circle"></span> Đang đợi admin duyệt tài khoản.
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@else
@section('content')
<div id="content" style="margin-top: 20px !important;margin-bottom: 0px !important;">
    <div class="m-grid__item m-grid__item--fluid m-grid  m-error-3">
        <div class="m-error_container text-center" style="color: #FFF">
            <span class="m-error_number">
                <h1>
                    Not active
                </h1>
            </span>
            <p class="m-error_title m--font-light">
                Chưa active tài khoản!
            </p>
            <a class="btn btn-danger" href="{{ route('user.logout') }}"><span class="fa fa-sign-out"></span> Thoát</a>
        </div>
    </div>
</div>
@endsection
@endif