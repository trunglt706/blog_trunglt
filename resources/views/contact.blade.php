@extends('layouts.auth.main')
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <h1><strong>LIÊN HỆ</strong></h1>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li class="active">Liên hệ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <main class="page_main_wrapper" style="transform: none;">
        <div class="container" style="transform: none;">
            <div class="row row-m" style="transform: none;">
                <div class="col-sm-8 main-content col-p" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; left: 271.5px; top: 0px;">
                        <!-- START CONTACT FORM AREA -->
                        <div class="contact_form_inner">
                            <div class="panel_inner">
                                <div class="panel_header">
                                    <h4><strong>Hãy gửi liên hệ cho chúng tôi</strong></h4>
                                </div>
                                <div class="panel_body">
                                    @include('layouts.auth.partials.notify')
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    <form class="comment-form" action="{{route('lienhe.post')}}" method="post">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Họ và tên *</label>
                                                    @csrf
                                                    <input type="text" required class="form-control" id="name" name="name" placeholder="Nhập tên ...">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="email">Email *</label>
                                                <div class="form-group">
                                                    <input type="email" required class="form-control" id="email" name="email" placeholder="Nhập email ...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Nôi dung *</label>
                                            <textarea class="form-control" required id="content" name="content" placeholder="Nhập nội dung ..." rows="5"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 text-left">
                                                <button class="btn btn-danger" type="submit"><i class="fa fa-send-o"></i> Gửi</button>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group">
                                                    {!! NoCaptcha::display() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
                                <h4><strong>Thông tin liên hệ</strong></h4>
                            </div>
                            <div class="panel_body">
                                <address> <strong><i class="ti-location-arrow"></i> Địa chỉ.</strong><br> Hoàng Văn Thụ, Q. Tân Bình, TP. Hồ Chí Minh</address>
                                <address> <strong><i class="ti-mobile"></i> Điện thoại.</strong><br> (+84)1677 300 950</address>
                                <address> <strong><i class="ti-email"></i> Email.</strong><br> lamthanhtrung706@gmail.com</address>
                            </div>
                        </div>
                        <!-- END OF /. CONTACT INFO -->
                        <!-- START SOCIAL ICON -->
                        @include('social-right');
                        <!-- END OF /. SOCIAL ICON -->
                    </div>
                </div>
            </div>
            <div class="panel_inner">
                <div class="panel_body">
                    <!-- The element that will contain Google Map. This is used in both the Javascript and CSS above. -->
                    <div id="map" style="position: relative; overflow: hidden;">
                        <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1385.6443181040222!2d106.69090096156509!3d10.796450649006621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528cef2c0d839%3A0x98f202f9a5a797d0!2zNiBIb2EgSOG7k25nLCBQaMaw4budbmcgNywgUGjDuiBOaHXhuq1uLCBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1537548467396" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection