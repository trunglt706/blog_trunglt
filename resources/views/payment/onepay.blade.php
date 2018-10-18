@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper">
    <!-- START PAGE HEADER -->
    <section class="inner-head" style="background-image: url(assets/images/faq-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title">THANH TOÁN ONEPAY</h1>
                    <p class="description">
                        Cổng thanh toán OnePay
                    </p>
                    <div class="breadcrumb">
                        <ul class="clearfix">
                            <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="ib"><a href="{{route('payment.index')}}">Thanh toán</a></li>
                            <li class="ib current-page">OnePay</li>
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
                    <a href="{{route('payment.onepay')}}" title="Cổng thanh toán OnePay"><img src="{{url('images/payment-online/logo-onepay.png')}}" alt="OnePay"/></a>
                </div>
                <div class="col-md-9">
                    <form class="m-form frm-payment" method="POST" action="{{ route('payment.recharge.noidia') }}" role="form">
                        @csrf                                
                        <div class="m-form__group form-group">
                            <label for="">Phương thức thanh toán</label>
                            <div class="m-radio-inline">
                                <label class="m-radio">
                                    <input class="type_payment" type="radio" name="type_payment" checked="checked" value="noidia"> Thẻ thanh toán nội địa
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input class="type_payment" type="radio" name="type_payment" value="quocte"> Thẻ thanh toán quốc tế
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại *</label>
                            <input type="text" class="form-control" required="" name="phone" placeholder="Nhập số điện thoại ..."/>
                        </div>
                        <div class="form-group div-noidia">
                            <label>Số tiền *</label>
                            <input class="form-control" required="" type="number" name="amount" size="20" maxlength="10" placeholder="Nhập số tiền ..."/>
                        </div>
                        <button class="btn btn-outline-accent m-btn m-btn--icon m-btn--outline-2x m-btn--pill m-btn--air" type="submit">
                            <span>
                                <span class="fa fa-money"></span> <span>Nạp tiền</span>
                            </span>
                        </button>
                    </form>
                    <div class="m-portlet__body payment-noidia hide-mobile">
                        <span class="m-section__sub">
                            * Danh sách ngân hàng nội địa hỗ trợ thanh toán trên Onepay
                        </span>
                        <div class="m-section__content">
                            <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                                <div class="m-demo__preview">
                                    <img style="width: 100%" src="{{url('images/payment-online/ngan-hang-noi-dia.PNG')}}" alt="Ngân hàng nội địa hỗ trợ thanh toán trên Onepay"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body payment-quocte hide-mobile" style="display: none;">
                        <span class="m-section__sub">
                            * Hiện tại chúng tôi mới chỉ hỗ trợ duy nhất đơn vị tiền tệ là VND<br/>
                            * Danh sách ngân hàng quốc tế hỗ trợ thanh toán trên Onepay
                        </span>
                        <div class="m-section__content">
                            <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                                <div class="m-demo__preview">
                                    <img src="{{url('images/payment-online/ngan-hang-quoc-te.PNG')}}" alt="Ngân hàng quốc tế hỗ trợ thanh toán trên Onepay"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
