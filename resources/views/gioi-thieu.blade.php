@extends('layouts.auth.main')
@section('content')
    <main class="page_main_wrapper">
        <!-- START PAGE HEADER -->
        <section class="inner-head" style=" background-image: url(assets/images/about-bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="entry-title">GIỚI THIỆU</h1>
                        <p class="description">
                            Hãy đến với chúng tôi, các bạn có thể tìm hiểu thêm về My blog - TrungLT với những câu chuyện hay, những tâm sự gần gủi với cuộc sống hằng ngày.
                        </p>
                        <div class="breadcrumb">
                            <ul class="clearfix">
                                <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                                <li class="ib current-page">Giới thiệu</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF /. PAGE HEADER -->
        <div class="team about-content">
            <div class="container">
                <div class="about-title">
                    <h1>Our Mission</h1>
                    <h3>It is a long established fact that a reader will be distracted</h3>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five .</p>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Our Valuable Team Members </h2>
                    </div>
                    <!-- end col-12 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <figure class="member"> <img src="assets/images/team/1.png" class="img-responsive" alt="Image">
                            <figcaption>
                                <h4>Debora Hilton</h4>
                                <small>Editor</small>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </figcaption>
                        </figure>
                        <!-- end member -->
                    </div>
                    <!-- end col-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <figure class="member"> <img src="assets/images/team/2.png" class="img-responsive" alt="Image">
                            <figcaption>
                                <h4>Debora Hilton</h4>
                                <small>Editor</small>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </figcaption>
                        </figure>
                        <!-- end member -->
                    </div>
                    <!-- end col-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <figure class="member"> <img src="assets/images/team/3.png" class="img-responsive" alt="Image">
                            <figcaption>
                                <h4>Chris O'Daniel</h4>
                                <small>Publisher</small>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </figcaption>
                        </figure>
                        <!-- end member -->
                    </div>
                    <!-- end col-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <figure class="member"> <img src="assets/images/team/4.png" class="img-responsive" alt="Image">
                            <figcaption>
                                <h4>Lian Holden</h4>
                                <small>Project Manager</small>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </figcaption>
                        </figure>
                        <!-- end member -->
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->

                <div class="about-title">
                    <h2>Bold History that Fuels the Future</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>
    </main>
@endsection