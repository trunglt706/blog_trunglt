@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper">
    <!-- START PAGE HEADER -->
    <section class="inner-head" style="background-image: url(assets/images/faq-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title">THANH TOÁN BẢO KIM</h1>
                    <p class="description">
                        Cổng thanh toán Bảo Kim
                    </p>
                    <div class="breadcrumb">
                        <ul class="clearfix">
                            <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="ib"><a href="{{route('payment.index')}}">Thanh toán</a></li>
                            <li class="ib current-page">Bảo Kim</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF /. PAGE HEADER -->
    <section class="faq-inner">
        <div class="container">
            @include('layouts.auth.partials.notify')
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="{{route('payment.baokim')}}" title="Cổng thanh toán Bảo Kim"><img src="{{url('images/payment-online/bk_logo.png')}}" alt="Bảo Kim"/></a>
                </div>
                <div class="col-md-9">
                    <form class="m-form frm-payment" method="POST" action="{{ route('payment.recharge.baokim') }}" role="form">
                        @csrf
                        <div class="form-group">
                            <label>Số điện thoại *</label>
                            <input type="text" class="form-control" required="" name="phone" placeholder="Nhập số điện thoại ..."/>
                        </div>
                        <div class="form-group div-noidia">
                            <label>Số tiền *</label>
                            <input class="form-control" required="" type="number" name="amount" size="20" maxlength="10" placeholder="Nhập số tiền ..."/>
                        </div>
                        <div class="m-widget2">
                            <div class="m-widget2__item m-widget2__item--primary">
                                <div class="m-widget2__checkbox">
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                        <input class="radio radio-2" type="radio" name="method" value="2">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="m-widget2__desc">
                                    <span class="m-widget2__text">
                                        Thanh toán trực tuyến bằng thẻ quốc tế
                                    </span>&nbsp;
                                    <img src="{{url('images/payment-online/baokim/creditcard.png')}}" border="0"/>
                                </div>
                                <div class="bank_list row">
                                    <ul id="b_l">
                                        <?php print(generateBankImage($banks, 2)) ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-widget2__item m-widget2__item--warning">
                                <div class="m-widget2__checkbox">
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                        <input class="radio radio-3 form-control" type="radio" name="method" value="3">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="m-widget2__desc">
                                    <span class="m-widget2__text">
                                        Chuyển khoản InternetBanking
                                    </span>&nbsp;
                                    <img src="{{url('images/payment-online/baokim/transfer.png')}}" border="0"/><br>
                                    <span class="m-widget2__user-name">
                                        <a href="#" class="m-widget2__link">
                                            Chọn ngân hàng thanh toán
                                        </a>	
                                    </span>	
                                </div>
                                <div class="bank_list row">
                                    <ul id="b_l">
                                        <?php print(generateBankImage($banks, 3)) ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-widget2__item m-widget2__item--brand">
                                <div class="m-widget2__checkbox">
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                        <input class="radio radio-1 form-control" type="radio" name="method" value="1">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="m-widget2__desc">
                                    <span class="m-widget2__text">
                                        Thanh toán trực tuyến bằng thể ATM nội địa
                                    </span>&nbsp;
                                    <img src="{{url('images/payment-online/baokim/atm.png')}}" border="0"/><br>
                                    <span class="m-widget2__user-name">
                                        <a href="#" class="m-widget2__link">
                                            Chọn ngân hàng thanh toán
                                        </a>	
                                    </span>	
                                </div>
                                <div class="bank_list row">
                                    <ul id="b_l">
                                        <?php print(generateBankImage($banks, 1)) ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-widget2__item m-widget2__item--success">
                                <div class="m-widget2__checkbox">
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                                        <input class="radio radio-0 form-control" type="radio" name="method" value="0" checked="checked">
                                        <span></span>
                                    </label>
                                </div>
                                <div class="m-widget2__desc">
                                    <span class="m-widget2__text">
                                        Thanh toán Bảo Kim
                                    </span><br>
                                    <span class="m-widget2__user-name">
                                        <a href="#" class="m-widget2__link">
                                            Thanh toán bằng tài khoản Bảo Kim (baokim.vn)
                                        </a>	
                                    </span>	                                        
                                </div>                                    
                            </div>
                        </div>
                        <input type="hidden" name="bank_payment_method_id" id="bank_payment_method_id" value=""/>
                        <input type="hidden" name="method" id="method" value="0"/>
                        <button class="btn btn-outline-accent m-btn m-btn--icon m-btn--outline-2x m-btn--pill m-btn--air" type="submit">
                            <span>
                                <span class="fa fa-money"></span> <span>Nạp tiền</span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection