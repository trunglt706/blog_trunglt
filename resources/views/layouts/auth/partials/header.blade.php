<header>
    <!-- START HEADER TOP SECTION -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6">
                    <!-- Start header social -->
                    <div class="header-social">
                        <ul>
                            <li><a target="_blank" href="{{$data['facebook']->value}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="{{$data['youtube']->value}}"><i class="fa fa-youtube-play"></i></a></li>
                            <li class="hidden-lg hidden-md hidden-sm"><a href=""><i class="fa fa-user"></i> Đăng ký thành viên</a></li>
                            <li class="hidden-lg hidden-md hidden-sm"><a href=""><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                        </ul>
                    </div>
                    <!-- End of /. header social -->
                </div>
                <!-- Start header top right menu -->
                <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 hidden-xs">
                    <!-- Start header social -->
                    <div class="header-right-menu">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i> Đăng ký thành viên</a></li>
                            <li><a href=""><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                        </ul>
                    </div>
                    <!-- End of /. header social -->
                </div> <!-- end of /. header top right menu -->
            </div> <!-- end of /. row -->
        </div> <!-- end of /. container -->
    </div>
    <!-- END OF /. HEADER TOP SECTION -->
    <!-- START MIDDLE SECTION -->
    <div class="header-mid hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo">
                        <a href="{{route('home')}}"><img src="{{url($data['logo']->value)}}" class="img-responsive" alt="{{$data['title']->value}}"></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <a href="{{route('home')}}"><img src="{{url('images/add728x90-1.jpg')}}" class="img-responsive" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF /. MIDDLE SECTION -->
    <!-- START NAVIGATION -->
    <div class="wrap-sticky" style="height: 50px;"><nav class="navbar navbar-default navbar-sticky navbar-mobile bootsnav on">
            <!-- Start Top Search -->
            <div class="top-search" style="display: none;">
                <div class="container">
                    <form class="search-form" action="{{route('search')}}" method="get">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" name="key" placeholder="Tìm kiếm ...">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Top Search -->
            <div class="container">
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href=""><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="{{route('home')}}"><img src="{{url($data['logo']->value)}}" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="" data-out="">
                        <li class="{{isActiveRoute('home')}}">
                            <a href="{{route('home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        </li>
                        <li class="{{isActiveRoute('introduce')}}">
                            <a href="{{route('introduce')}}"><i class="fa fa-th-large"></i> Giới thiệu</a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-newspaper-o"></i> Danh mục bài viết</a>
                            @if(!is_null($data['danhmuc']))
                                <ul class="dropdown-menu animated" style="display: none;">
                                    @foreach($data['danhmuc'] as $dmuc)
                                        <li><a href="{{route('danhmuc.baiviet', ['slug' => $dmuc->slug])}}">{{$dmuc->name}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="{{isActiveRoute('tacgia.list')}}"><a href="{{route('tacgia.list')}}"><i class="fa fa-user-circle-o"></i> Tác giả</a></li>
                        <li class="{{isActiveRoute('contact')}}"><a href="{{route('contact')}}"><i class="fa fa-address-card-o"></i> Liên hệ</a></li>
                        <li class="{{isActiveRoute('hoidap')}}"><a href="{{route('hoidap')}}"><i class="fa fa-question-circle"></i> Hỏi đáp</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav></div>
    <!-- END OF/. NAVIGATION -->
</header>
<!-- *** END OF /. PAGE HEADER SECTION *** -->