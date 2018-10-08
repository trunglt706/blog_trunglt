@extends('layouts.auth.main')
@section('content')
<!-- *** START PAGE MAIN CONTENT *** -->
<main class="page_main_wrapper" style="transform: none;">
    <!-- START POST BLOCK SECTION -->
    <section class="slider-inner">
        <div class="container">
            @include('layouts.auth.partials.notify')
            <div class="row thm-margin">
                {{--Start important news--}}
                @if(isset($data['news']))
                <div class="col-xs-12 col-sm-8 col-md-8 thm-padding">
                    <div class="slider-wrapper">
                        <div class="item">
                            <div class="slider-post post-height-1">
                                <a href="{{route('detail.baiviet', ['slug' => $data['important']->slug])}}" class="news-image">
                                    <img src="{{url($data['important']->thumn)}}" alt="{{$data['important']->name}}" class="img-responsive">
                                </a>
                                <div class="post-text">
                                    <span class="post-category">Hot news</span>
                                    <h2>
                                        <a href="{{route('detail.baiviet', ['slug' => $data['important']->slug])}}">
                                            {{$data['important']->name}}
                                        </a>
                                    </h2>
                                    <ul class="authar-info">
                                        <li class="authar"><a href="">By admin</a></li>
                                        <li class="date">{{date('d/m/Y', strtotime($data['important']->created_at))}}</li>
                                        <li class="view"><a href="">{{$data['important']->view}} views</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                {{--End important news--}}
                {{--Start advs--}}
                @if(isset($data['advs']))
                <div class="col-xs-12 col-sm-4 col-md-4 thm-padding">
                    <div class="row slider-right-post thm-margin">
                        @foreach($data['advs'] as $adv)
                        <div class="col-xs-6 col-sm-12 col-md-12 thm-padding">
                            <div class="slider-post post-height-2">
                                <a href="{{$adv->link}}" class="news-image">
                                    <img src="{{url($adv->photo)}}" alt="{{$adv->name}}" class="img-responsive">
                                </a>
                                <div class="post-text">
                                    <span class="post-category">Advs</span>
                                    <h4><a href="{{$adv->link}}">{{$adv->name}}</a></h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                {{--End advs--}}
            </div>
        </div>
    </section>
    <!-- END OF /. POST BLOCK SECTION -->
    {{--START LIST NEWS LATSTED--}}
    <section class="articles-wrapper" style="transform: none;">
        <div class="container" style="transform: none;">
            <div class="row row-m" style="transform: none;">
                @if(isset($data['news']))
                <div class="col-sm-8 main-content col-p" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                        <!-- START POST CATEGORY STYLE FOUR (Latest articles ) -->
                        <div class="post-inner">
                            <!--post header-->
                            <div class="post-head">
                                <h2 class="title"><span class="fa fa-newspaper-o"></span></span> &nbsp;<strong>Bài viết mới nhất</strong></h2>
                            </div>
                            <!-- post body -->
                            <div class="post-body">
                                @foreach($data['news'] as $news)
                                <div class="news-list-item articles-list post-grid-item">
                                    <div class="img-wrapper posts-thumb">
                                        <a href="{{route('detail.baiviet', ['slug' => $news->slug])}}" class="thumb">
                                            <img src="{{url($news->thumn)}}" alt="{{$news->name}}" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="post-info-2">
                                        <h4>
                                            <a href="{{route('detail.baiviet', ['slug' => $news->slug])}}" class="title">
                                                {{$news->name}}
                                            </a>
                                        </h4>
                                        <ul class="authar-info">
                                            <li><i class="ti-timer"></i> {{date('H:i:s d/m/Y', strtotime($news->created_at))}}</li>
                                            <li class="like"><i class="ti-eye"></i>{{$news->view}} views</li>
                                            <li class="like"><i class="ti-thumb-up"></i>{{$news->like}} likes</li>
                                        </ul>
                                        <p class="hidden-sm">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...</p>
                                    </div>
                                </div>
                                @endforeach
                            </div> <!-- /. post body -->
                        </div>
                        <!-- END OF /. POST CATEGORY STYLE FOUR (Latest articles ) -->
                    </div>
                </div>
                @endif
                <div class="col-sm-4 rightSidebar col-p" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 971.5px;">
                        <!-- START POLL WIDGET -->
                        @include('social-right')
                        <!-- END OF /. POLL WIDGET -->
                        <!-- START TAGS -->
                        @include('tag-right')
                        <!-- END OF /. TAGS -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--END LIST NEWS LASTED--}}
</main>
<!-- *** END OF /. PAGE MAIN CONTENT *** -->
@endsection