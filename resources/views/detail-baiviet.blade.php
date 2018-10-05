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
                                @php
                                $author = !is_null(getUser($data['news']->username)) ? getUser($data['news']->username)->name : "No author";
                                @endphp
                                <li>By <a href="{{route('tacgia.index', ['id' => $data['news']->username])}}" target="_blank">{{$author}}</a></li>
                                <li><i class="ti-timer"></i> {{date('d/m/Y', strtotime($data['news']->created_at))}}</li>
                                <li><i class="ti-thumb-up"></i>{{$data['news']->like}} likes</a></li>
                                <li><i class="ti-eye"></i>{{$data['news']->view}} views</a></li>
                            </ul>
                            <div class="content-baiviet">
                                <?= $data['news']->content ?>
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
                            <h2 class="title"><strong><i class="fa fa-newspaper-o"></i> Bài viết cùng chủ đề </strong></h2>
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
                                                                    <a href="{{route('detail.baiviet', ['slug' => $other->slug])}}">
                                                                        <img src="{{url($other->thumn)}}" class="img-responsive" alt="{{$other->slug}}" style="max-height: 215px;">
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