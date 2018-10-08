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
                                    <article class="post-grid-item">
                                        <figure class="posts-thumb">
                                            <a href="{{route('detail.baiviet', ['slug' => $bviet->slug])}}">
                                                <img src="{{url($bviet->thumn)}}" alt="{{$bviet->slug}}" class="img-responsive img-news">
                                            </a>
                                            <span class="post-category">News</span>
                                        </figure>
                                        <div class="post-info">
                                            <h5 class="title-news"><a href="{{route('detail.baiviet', ['slug' => $bviet->slug])}}">{{$bviet->name}}</a></h5>
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
                    @include('baiviet_view_like_right')
                    <!-- END OF /. NAV TABS -->
                    @include('social-right')
                </div>
            </div>
            <!-- END OF /. SIDE CONTENT -->
        </div>
    </div>
</main>
@endsection