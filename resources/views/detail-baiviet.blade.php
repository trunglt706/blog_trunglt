@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper" style="transform: none;">
    <!-- START PAGE TITLE -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <h1><strong style="text-transform: uppercase    ">{{$data['danhmuc']->name}}</strong></h1>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li class="active"><a href="{{route('danhmuc.baiviet', ['slug' => $data['danhmuc']->slug])}}">{{$data['danhmuc']->name}}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF /. PAGE TITLE -->
    <div class="container" style="transform: none;">
        <div class="row row-m" style="transform: none;">
            <!-- START MAIN CONTENT -->
            <div class="col-sm-8 col-p  main-content" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <div class="post_details_inner">
                        <div class="post_details_block">
                            <figure class="social-icon">
                                <img src="{{url($data['news']->thumn)}}" class="img-responsive" alt="">
                                <div>
                                    <a href="javascript:;">
                                        <div class="fb-share-button" data-href="{{route('detail.baiviet', ['slug' => $data['news']->slug])}}" data-layout="button" data-size="small" data-mobile-iframe="true">
                                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('detail.baiviet', ['slug' => $data['news']->slug])}}" class="fb-xfbml-parse-ignore">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </div>
                                    </a>
                                </div>
                            </figure>
                            <h2>{{$data['news']->name}}</h2>
                            <ul class="authar-info">
                                <li>By {{!is_null(getUser($data['news']->username)) ? getUser($data['news']->username)->name : "No author"}}</li>
                                <li><i class="ti-timer"></i> {{date('d/m/Y', strtotime($data['news']->created_at))}}</li>
                                <li><i class="ti-thumb-up"></i>{{$data['news']->like}} likes</a></li>
                                <li><i class="ti-eye"></i>{{$data['news']->view}} views</a></li>
                            </ul>
                            <div class="content-baiviet">
                                {{$data['news']->content}}
                            </div>
                        </div>
                        @if (!is_null($data['news']->keyword))
                        <div class="post-footer">
                            <div class="row thm-margin">
                                <div class="col-xs-12 col-sm-12 col-md-12 thm-padding">
                                    <div class="panel-body">
                                        {{--Tags--}}
                                        Tags: &nbsp;
                                            @php
                                                $strkey = str_replace(',', ';', $data['news']->keyword);
                                                $arrkey = explode(";", $strkey);
                                            @endphp
                                            @for ($cout = 0; $cout < count($arrkey); $cout++)
                                                @if(trim($arrkey[$cout]) != "")
                                                    <a class="ui tag" href="{{route('search')}}?key={{$arrkey[$cout]}}">
                                                        {{str_replace(str_split(',;'), '', $arrkey[$cout])}}
                                                    </a>&nbsp;
                                                @endif
                                            @endfor
                                        {{--End tags--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    {{--Start comment--}}
                    <div class="comments-container">
                        <div class="fb-comments" data-href="{{route('detail.baiviet', ['slug' => $data['news']->slug])}}" data-width="100%" data-numposts="5"></div>
                    </div>
                    {{--End comment--}}
                    <!-- START RELATED ARTICLES -->
                    @if(!is_null($data['new_other']))
                    <div class="post-inner post-inner-2">
                        <!--post header-->
                        <div class="post-head">
                            <h2 class="title"><strong>Bài viết cùng chủ đề </strong></h2>
                        </div>
                        <!-- post body -->
                        <div class="post-body">
                            <div id="post-slider-2" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                                <!-- item one -->
                                <div class="owl-wrapper-outer">
                                    <div class="owl-wrapper" style="width: 2640px; left: 0px; display: block;">
                                        <div class="owl-item" style="width: 660px;">
                                            <div class="item">
                                                <div class="news-grid-2">
                                                    <div class="row row-margin">
                                                        @foreach($data['new_other'] as $other)
                                                        <div class="col-xs-6 col-sm-4 col-md-4 col-padding">
                                                            <div class="grid-item">
                                                                <div class="grid-item-img">
                                                                    <a href="#">
                                                                        <img src="{{url($other->thumn)}}" class="img-responsive" alt="{{$other->slug}}">
                                                                        <div class="link-icon"><i class="fa fa-play"></i></div>
                                                                    </a>
                                                                </div>
                                                                <h5><a href="{{route('detail.baiviet', ['slug' => $other->slug])}}" class="title">{{$other->name}}</a></h5>
                                                                <ul class="authar-info">
                                                                    <li><i class="ti-timer"></i> {{date('d/m/Y', strtotime($other->created_at))}}</li>
                                                                    <li><i class="ti-eye"></i>{{$other->view}} views</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- item two -->
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- END OF /. RELATED ARTICLES -->
                    <!-- START COMMENTS FORMS -->
                    {{--<form class="comment-form" action="{{route('phanhoi.post')}}" method="post">--}}
                        {{--<h3><strong>Để lại chút bình luận</strong></h3>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="name">Họ tên *</label>--}}
                                    {{--<input type="text" required class="form-control" id="name" name="name" placeholder="Nhập tên ...">--}}
                                    {{--<input type="hidden" name="id_baiviet" value="{{$data['news']->id}}">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<label for="email">Email*</label>--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="email" required class="form-control" id="email" name="email" placeholder="Nhập email ...">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="content">Nội dung</label>--}}
                            {{--<textarea class="form-control" required id="content" name="content" placeholder="Nội dung bình luận ..." rows="5"></textarea>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6 text-left">--}}
                                {{--<button class="btn btn-danger" type="submit"><i class="fa fa-send-o"></i> Gửi</button>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<div class="form-group m-form__group">--}}
                                    {{--{!! NoCaptcha::display() !!}--}}
                                    {{--@if ($errors->has('g-recaptcha-response'))--}}
                                        {{--<div class="has-danger">--}}
                                    {{--<span class="form-control-feedback">--}}
                                        {{--<strong>{{ $errors->first('g-recaptcha-response') }}</strong>--}}
                                    {{--</span>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                    <!-- END OF /. COMMENTS FORMS -->
                    <!-- START COMMENT -->
                    {{--@if(!is_null($data['comment']))--}}
                    {{--<div class="comments-container">--}}
                        {{--<h3><strong>Bình luận ({{count($data['comment'])}})</strong></h3>--}}
                        {{--<ul class="comments-list">--}}
                            {{--@php $cment = 0; @endphp--}}
                            {{--@foreach($data['comment'] as $comment)--}}
                                {{--@php $cment++; @endphp--}}
                            {{--<li>--}}
                                {{--<div class="comment-main-level">--}}
                                    {{--<!-- Avatar -->--}}
                                    {{--<div class="comment-avatar" @if($cment%2 == 0) style="float: right;" @endif><img src="{{url('images/218x150-1.JPG')}}" alt=""></div>--}}
                                    {{--<div class="comment-box">--}}
                                        {{--<div class="comment-content">--}}
                                            {{--<div class="comment-header"> <cite class="comment-author">- {{$comment->name}}</cite>--}}
                                                {{--<time datetime="2012-10-27" class="comment-datetime">{{date('H:i:s d/m/Y', strtotime($comment->created_at))}}</time>--}}
                                            {{--</div>--}}
                                            {{--<p>{{$comment->content}}</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    <!-- END OF /. COMMENT -->
                </div>
            </div>
            <!-- END OF /. MAIN CONTENT -->
            <!-- START SIDE CONTENT -->
            <div class="col-sm-4 col-p rightSidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 971.5px;">
                    <!-- START NAV TABS -->
                    @include('baiviet_view_like_right')
                    <!-- END OF /. NAV TABS -->
                    <!-- START SOCIAL ICON -->
                    @include('social-right')
                    <!-- END OF /. SOCIAL ICON -->
                </div>
            </div>
            <!-- END OF /. SIDE CONTENT -->
        </div>
    </div>
</main>
@endsection