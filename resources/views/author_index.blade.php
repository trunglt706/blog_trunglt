@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper" style="transform: none;">
    <section class="inner-head" style="@if(!is_null($object['author']->background) && ($object['author']->background != '')) background-image: url({{url($object['author']->background)}}); @else background-color: #006269 ; @endif">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title" style="text-transform: uppercase;">{{$object['author']->name}}</h1>
                    <div class="breadcrumb">
                        <ul class="clearfix">
                            <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="ib current-page">Tác giả</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container" style="transform: none;">
        <div class="row row-m" style="transform: none;">
            <div class="col-sm-8 main-content col-p" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 271.5px; top: 0px;">
                    <!-- START CONTACT FORM AREA -->
                    <div class="contact_form_inner">
                        <div class="panel_inner">
                            <div class="panel_header">
                                <h4><strong><i class="fa fa-user-circle-o"></i> Giới thiệu đôi nét về tác giả</strong></h4>
                            </div>
                            <div class="panel_body">
                                <p><?= $object['author']->intro ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- END OF CONTACT FORM AREA -->
                </div>
            </div>
            <div class="col-sm-4 rightSidebar col-p" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <!-- START CONTACT INFO -->
                    <div class="panel_inner">
                        <div class="panel_header">
                            <h4><strong><i class="fa fa-address-card-o"></i> Thông tin liên hệ</strong></h4>
                        </div>
                        <div class="panel_body text-center">
                            <address>                                
                                <img class="img-circle" src="{{(!is_null($object['author']->avatar) && ($object['author']->avatar != "")) ? url($object['author']->avatar) : url('images/no-image.jpg')}}" alt="{{$object['author']->name}}" style="max-width: 100px;"/>
                            </address>
                            <address> {{$object['author']->name}}</address>
                            <address> {{$object['author']->email}}</address>
                        </div>
                    </div>
                    <!-- END OF /. CONTACT INFO -->
                    <!-- START SOCIAL ICON -->
                    @include('social-right');
                    <!-- END OF /. SOCIAL ICON -->
                </div>
            </div>
        </div>
        @if(!is_null($object['list_bviet']))
        <div class="panel_inner">
            <!--post header-->
            <div class="post-head">
                <h2 class="title"><strong><i class="fa fa-newspaper-o"></i> Một số bài viết của tác giả </strong></h2>
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
                                            @foreach($object['list_bviet'] as $other)
                                            <div class="col-xs-6 col-sm-4 col-md-4 col-padding">
                                                <div class="grid-item post-grid-item">
                                                    <div class="grid-item-img posts-thumb">
                                                        <a href="{{route('detail.baiviet', ['slug' => $other->slug])}}">
                                                            <img src="{{(!is_null($other->thumn) && ($other->thumn != "")) ? url($other->thumn) : url('images/no-image.jpg')}}" class="img-responsive img-news" alt="{{$other->slug}}">
                                                            <div class="link-icon"><i class="fa fa-play"></i></div>
                                                        </a>
                                                    </div>
                                                    <h5 class="title-news"><a href="{{route('detail.baiviet', ['slug' => $other->slug])}}" class="title">{{$other->name}}</a></h5>
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
    </div>
</main>
@endsection