<!-- *** START FOOTER *** -->
<footer>
    <div class="container">
        <div class="row">
            <!-- START FOOTER BOX (About) -->
            <div class="col-sm-6 footer-box">
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
                <h3 class="wiget-title">Danh mục bài viết</h3>
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
            <div class="col-sm-3 footer-box hidden-xs">
                <h3 class="wiget-title">Góp ý của khách</h3>
                <div class="footer-news-grid">
                    <div class="news-list-item">
                        <textarea rows="3" class="form-control" placeholder="Góp ý website"></textarea>
                        <br/>
                        <button class="btn btn-danger" type="submit">Gửi</button>
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
                <div class="copy">Copyright@2018 TrungLT.</div>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7 hidden-xs">
                <ul class="footer-nav">
                    <li>Số lượt truy cập: <b>1.000</b></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- *** END OF /. SUB FOOTER *** -->