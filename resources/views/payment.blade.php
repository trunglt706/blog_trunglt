@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper">
    <!-- START PAGE HEADER -->
    <section class="inner-head" style="background-image: url(assets/images/faq-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title">THANH TOÁN</h1>
                    <p class="description">
                        Kênh thanh toán đa dạng, tiện lợi và bảo mật thông qua các dịch vụ thanh toán như: Onepay, Ngân lượng, Paypal, Bảo kim hay VNPay.
                    </p>
                    <div class="breadcrumb">
                        <ul class="clearfix">
                            <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="ib current-page">Thanh toán</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF /. PAGE HEADER -->
    <section class="faq-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="{{route('payment.onepay')}}" title="Cổng thanh toán OnePay"><img src="{{url('images/payment-online/logo-onepay.png')}}" alt="Onepay"/></a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{route('payment.baokim')}}" title="Cổng thanh toán Bảo Kim"><img src="{{url('images/payment-online/bk_logo.png')}}" alt="Bảo Kim"/></a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{route('payment.nganluong')}}" title="Cổng thanh toán Ngân Lượng"><img src="{{url('images/payment-online/logoNL.png')}}" alt="Ngân Lượng"/></a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="{{route('payment.vnpay')}}" title="Cổng thanh toán VNPay"><img src="{{url('images/payment-online/vnpay.png')}}" alt="VNPay"/></a>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection