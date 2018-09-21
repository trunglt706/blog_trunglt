@extends('layouts.auth.main')
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <h1><strong style="text-transform: uppercase">{{$data['danhmuc']->name}}</strong></h1>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li class="active">{{$data['danhmuc']->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <main class="page_main_wrapper" style="transform: none;">
        <div class="container" style="transform: none;">
            <div class="row row-m" style="transform: none;">
                <!-- START MAIN CONTENT -->
                @if(isset($data['list_baiviet']))
                <div class="col-sm-8 col-p  main-content" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                        <div class="post-inner categoty-style-1">
                            <!-- post body -->
                            <div class="post-body">
                                <div class="row row-m">
                                    @foreach($data['list_baiviet'] as $bviet)
                                    <div class="col-sm-6 col-p">
                                        <article>
                                            <figure>
                                                <a href="{{route('detail.baiviet', ['slug' => $bviet->slug])}}">
                                                    <img src="{{url($bviet->thumn)}}" height="242" width="345" alt="{{$bviet->slug}}" class="img-responsive">
                                                </a>
                                                <span class="post-category">News</span>
                                            </figure>
                                            <div class="post-info">
                                                <h4><a href="{{route('detail.baiviet', ['slug' => $bviet->slug])}}">{{$bviet->name}}</a></h4>
                                                <ul class="authar-info">
                                                    <li><i class="ti-timer"></i> {{date('H:i:s d/m/Y', strtotime($bviet->created_at))}}</li>
                                                    <li><i class="ti-thumb-up"></i>{{$bviet->view}} views</li>
                                                </ul>
                                            </div>
                                        </article>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Post footer -->
                            <div class="post-footer">
                                <div class="row thm-margin">
                                    <div class="col-xs-12 col-sm-12 col-md-12 thm-padding">
                                        <!-- pagination -->
                                        {{ $data['list_baiviet']->links() }}
                                        <!-- /.pagination -->
                                    </div>
                                </div>
                            </div> <!-- /.Post footer-->
                        </div>
                    </div>
                </div>
                @endif
                <!-- END OF /. MAIN CONTENT -->
                <!-- START SIDE CONTENT -->
                <div class="col-sm-4 col-p rightSidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 971.5px;">
                        <!-- START NAV TABS -->
                        <div class="tabs-wrapper">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#baiviet_view" aria-controls="baiviet_view" role="tab" data-toggle="tab">Xem nhiều nhất</a></li>
                                <li role="presentation"><a href="#baiviet_like" aria-controls="baiviet_like" role="tab" data-toggle="tab">Thích nhiều nhất</a></li>
                            </ul>
                            <!-- Tab panels one -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="baiviet_view">
                                    <div class="most-viewed">
                                        <ul id="most-today" class="content tabs-content">
                                            <li><span class="count">01</span><span class="text"><a href="#">South Africa bounce back on eventful day</a></span></li>
                                            <li><span class="count">02</span><span class="text"><a href="#">Steyn ruled out of series with shoulder fracture</a></span></li>
                                            <li><span class="count">03</span><span class="text"><a href="#">BCCI asks ECB to bear expenses of team's India tour</a></span></li>
                                            <li><span class="count">04</span><span class="text"><a href="#">Duminy, Elgar tons set Australia huge target</a></span></li>
                                            <li><span class="count">05</span><span class="text"><a href="#">English spinners are third-class citizens, says Graeme Swann</a></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Tab panels two -->
                                <div role="tabpanel" class="tab-pane fade" id="baiviet_like">
                                    <div class="popular-news">
                                        <div class="p-post">
                                            <h4><a href="#">It is a long established fact that a reader will be distracted by  </a></h4>
                                            <ul class="authar-info">
                                                <li><a href="#" class="link"><i class="ti-timer"></i> May 15, 2016</a></li>
                                                <li><a href="#" class="link"><i class="ti-thumb-up"></i>15 likes</a></li>
                                            </ul>
                                            <div class="reatting-2">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="p-post">
                                            <h4><a href="#">It is a long established fact that a reader will be distracted by  </a></h4>
                                            <ul class="authar-info">
                                                <li><a href="#" class="link"><i class="ti-timer"></i> May 15, 2016</a></li>
                                                <li><a href="#" class="link"><i class="ti-thumb-up"></i>15 likes</a></li>
                                            </ul>
                                            <div class="reatting-2">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="p-post">
                                            <h4><a href="#">It is a long established fact that a reader will be distracted by  </a></h4>
                                            <ul class="authar-info">
                                                <li><a href="#" class="link"><i class="ti-timer"></i> May 15, 2016</a></li>
                                                <li><a href="#" class="link"><i class="ti-thumb-up"></i>15 likes</a></li>
                                            </ul>
                                            <div class="reatting-2">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF /. NAV TABS -->

                        <!-- START SOCIAL ICON -->
                        <div class="social-media-inner">
                            <ul class="social-media clearfix">
                                <li>
                                    <a href="#" class="rss">
                                        <i class="fa fa-rss"></i>
                                        <div>2,035</div>
                                        <p>Subscribers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="fb">
                                        <i class="fa fa-facebook"></i>
                                        <div>3,794</div>
                                        <p>Fans</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="g_plus">
                                        <i class="fa fa-google-plus"></i>
                                        <div>941</div>
                                        <p>Followers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="you_tube">
                                        <i class="fa fa-youtube-play"></i>
                                        <div>7,820</div>
                                        <p>Subscribers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="twitter">
                                        <i class="fa fa-twitter"></i>
                                        <div>1,562</div>
                                        <p>Followers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="pint">
                                        <i class="fa fa-pinterest"></i>
                                        <div>1,310</div>
                                        <p>Followers</p>
                                    </a>
                                </li>
                            </ul> <!-- /.social icon -->
                        </div>
                        <!-- END OF /. SOCIAL ICON -->
                    </div>
                </div>
                <!-- END OF /. SIDE CONTENT -->
            </div>
        </div>
    </main>
@endsection