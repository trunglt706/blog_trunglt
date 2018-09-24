<!-- *** START FOOTER *** -->
<footer>
    <div class="container">
        <div class="row">
            <!-- START FOOTER BOX (About) -->
            <div class="col-sm-5 footer-box">
                <div class="about-inner">
                    <img src="/images/logo-white.png" class="img-responsive" alt="">
                    <p>Những bài viết của tôi gắn liền với cuộc đời tôi và cuộc sống xung quang tôi</p>
                    <ul>
                        <li><i class="ti-location-arrow"></i>Hoàng Văn Thụ, Q. Tân Bình, TP. Hồ Chí Minh</li>
                        <li><i class="ti-mobile"></i>(+84)1677 300 950</li>
                        <li><i class="ti-email"></i>lamthanhtrung706@gmail.com</li>
                    </ul>
                </div>
            </div>
            <!--  END OF /. FOOTER BOX (About) -->
            <!-- START FOOTER BOX (Category) -->
            <div class="col-sm-3 footer-box hidden-xs">
                <h4 class="wiget-title">DANH MỤC BÀI VIẾT</h4>
                @if(!is_null($data['danhmuc']))
                    <ul class="menu-services">
                        @foreach($data['danhmuc'] as $dmuc)
                            <li><a href="{{route('danhmuc.baiviet', ['slug' => $dmuc->slug])}}">{{$dmuc->name}}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <!-- END OF /. FOOTER BOX (Category) -->
            <!-- START FOOTER BOX (Recent Post) -->
            <div class="col-sm-4 footer-box hidden-xs">
                <h4 class="wiget-title">FANPAGE MY BLOCK</h4>
                <div class="footer-news-grid">
                    <div class="news-list-item">
                        <div class="fb-page" data-href="https://www.facebook.com/clbmekongsp" data-tabs="timeline" data-width="350" data-height="180" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/clbmekongsp" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/clbmekongsp">CLB Sản phẩm đặc trưng ĐBSCL</a></blockquote></div>
                    </div>
                </div>
            </div>
            <!-- END OF /. FOOTER BOX (Recent Post) -->
        </div>
    </div>
</footer>
<!-- *** END OF /. FOOTER *** -->
<!-- *** START SUB FOOTER *** -->
<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-5">
                <div class="copy">Copyright @ 2018 TrungLT.</div>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7 hidden-xs">
                <ul class="footer-nav">
                    <li>Số lượt truy cập: &nbsp;&nbsp;&nbsp;<b><?php echo $data['countVisitor']; ?></b></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- *** END OF /. SUB FOOTER *** -->