@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper">
    <!-- START PAGE HEADER -->
    <section class="inner-head" style="background-image: url(assets/images/faq-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title">THANH TOÁN PAYPAL</h1>
                    <p class="description">
                        Cổng thanh toán PayPal
                    </p>
                    <div class="breadcrumb">
                        <ul class="clearfix">
                            <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="ib"><a href="{{route('payment.index')}}">Thanh toán</a></li>
                            <li class="ib current-page">PayPal</li>
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
                    <a href="{{route('payment.paypal')}}" title="Cổng thanh toán PayPal"><img src="{{url('images/payment-online/logo-paypal.png')}}" alt="PayPal"/></a>
                </div>
                <div class="col-md-9">
                    <form class="m-form frm-payment" method="POST" action="{{ route('payment.recharge.paypal') }}" role="form">
                        @csrf
                        <div class="form-group">
                            <label>Số điện thoại *</label>
                            <input type="text" class="form-control" required="" name="phone" placeholder="Nhập số điện thoại ..."/>
                        </div>
                        <div class="form-group div-noidia">
                            <label>Số tiền <small>(lớn hơn hoặc bằng 4.35 USD hoặc 100.000 VNĐ)</small></label>
                            <input class="form-control vpc_Amount" required="" type="number" name="amount" placeholder="Nhập số tiên ..." size="20" maxlength="10" />
                        </div>
                        <button class="btn btn-outline-accent m-btn m-btn--icon m-btn--outline-2x m-btn--pill m-btn--air" type="submit">
                            <span>
                                <span class="fa fa-money"></span> <span>Nạp tiền</span>
                            </span>
                        </button>
                        <div class="bs-callout bs-callout-danger" style="margin-top: 30px;">
                            <p>- Tỷ giá hiện tại giữa USD và VND là: <b>23.000 VND</b>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection