<header>
    <!-- START HEADER TOP SECTION -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6">
                    <!-- Start header social -->
                    <div class="header-social">
                        <ul>
                            <li><a href="https://fb.com/trunglt706"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://goo.gl/xP7MdL"><i class="fa fa-youtube-play"></i></a></li>
                        </ul>
                    </div>
                    <!-- End of /. header social -->
                </div>
                <!-- Start header top right menu -->
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <div class="header-right-menu">
                        <ul>
                            <li><a href="">Đăng ký</a></li>
                            <li><a href="">Đăng nhập</a></li>
                        </ul>
                    </div>
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
                        <a href="{{route('home')}}"><img src="/images/logo.png" class="img-responsive" alt=""></a>

                    </div>
                </div>
                <div class="col-sm-8">
                    <a href="{{route('home')}}"><img src="/images/add728x90-1.jpg" class="img-responsive" alt=""></a>
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
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
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
                    <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="{{route('home')}}"><img src="/images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left" data-in="" data-out="">
                        <li class="dropdown active">
                            <a href="{{route('home')}}">Trang chủ</a>
                        </li>
                        <li class="dropdown megamenu-fw">
                            <a href="{{route('introduce')}}">Giới thiệu</a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Danh mục bài viết</a>
                            @if(!is_null($data['danhmuc']))
                                <ul class="dropdown-menu animated" style="display: none;">
                                    @foreach($data['danhmuc'] as $dmuc)
                                        <li><a href="{{route('danhmuc.baiviet', ['slug' => $dmuc->slug])}}">{{$dmuc->name}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li><a href="{{route('contact')}}">Liên hệ</a></li>
                        <li><a href="{{route('hoidap')}}">Hỏi đáp</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav></div>
    <!-- END OF/. NAVIGATION -->
</header>
<!-- *** END OF /. PAGE HEADER SECTION *** -->