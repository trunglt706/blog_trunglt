@extends('layouts.auth.main')
@section('content')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h1><strong>DANH SÁCH TÁC GIẢ</strong></h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <ol class="breadcrumb">
                    <li><a href="{{route('home')}}">Trang chủ</a></li>
                    <li class="active">Danh sách tác giả</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<main class="page_main_wrapper" style="transform: none;">
    <div class="container" style="transform: none;">
        <div class="row row-m" style="transform: none;">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-search"></i>
                        @php
                        $count_admin = !is_null($list_author_admin) ? count($list_author_admin) : 0;
                        $count_user = !is_null($list_author_user) ? count($list_author_user) : 0;
                        $count_tong = $count_admin + $count_user;
                        @endphp
                        <span class="caption-subject"> Tìm thấy <span class="badge bg-aqua">{{$count_tong}}</span> tác giả</span>
                    </div>
                    <div class="inputs">
                        <div class="portlet-input input-inline input-medium">
                            <form method="get" action="{{route('tacgia.list')}}">
                                <div class="input-group">
                                    <input type="text" name="key" value="{{(isset($key_author) &&($key_author != '')) ? $key_author : ''}}" class="form-control input-circle-left" placeholder="Tìm tác giả...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-circle-right btn-default" type="submit">Tìm</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row team about-content">
                        <!--Hien thi ds tac gia la admin-->
                        @if(!is_null($list_author_admin))
                        @foreach($list_author_admin as $ad)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <a href="{{route('tacgia.index', ['id' => $ad['username']])}}">
                                <figure class="member">
                                    <img src="{{url($ad['avatar'])}}" class="img-responsive img-circle img-news" alt="{{$ad['name']}}">
                                    <figcaption>
                                        <h4 class="text-uppercase text-admin">[Admin] {{$ad['name']}}</h4>
                                        <small>Số bài viết: <span class="badge"><?= App\baiviets::countBaiVietUser($ad['username']) ?></span></small>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        @endforeach
                        @endif
                        <!--End hien thi danh sach tac gia la admin-->
                        <!--Hien thi ds tac gia la user-->
                        @if(!is_null($list_author_user))
                        @foreach($list_author_user as $us)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <a href="{{route('tacgia.index', ['id' => $us['username']])}}">
                                <figure class="member">
                                    <img src="{{url($us['avatar'])}}" class="img-responsive img-circle img-news" alt="{{$us['name']}}">
                                    <figcaption>
                                        <h4 class="text-uppercase">{{$us['name']}}</h4>
                                        <small>Số bài viết: <span class="badge"><?= App\baiviets::countBaiVietUser($us['username']) ?></span></small>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        @endforeach
                        @endif
                        <!--End hien thi danh sach tac gia la user-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection