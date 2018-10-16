@extends('layouts.auth.main')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <a href="{{route('payment')}}">{{trans('storage.recharge')}}</a> / PayPal.com
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    {{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    {{ session('success') }}				  	
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 hide-mobile">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="text-center" style="padding-top: 20px;">
                        <img class="img-responsive img-circle" style="max-width: 100%" src="/assets/images/logo-paypal.png" alt="PayPal"/>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
                    <div class="m-portlet__head" style="">
                        <div class="m-portlet__head-progress"><!-- here can place a progress bar--></div>
                        <div class="m-portlet__head-wrapper">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title" style="padding-top: 25px;">
                                    <span class="m-portlet__head-icon">
                                        <i class="la la-bank"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Storage - Thanh toán trực tuyến thông qua PayPal.com
                                    </h3>
                                </div>			
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                              <form class="m-form frm-payment" method="POST" action="{{ route('user.recharge.paypal') }}" style="width: 100%;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="m-portlet__body">
                                    <div class="form-group div-noidia">
                                        <label>Số tiền <small>(lớn hơn hoặc bằng 4.35 USD hoặc 100.000 VNĐ)</small></label>
                                        <input class="form-control vpc_Amount" required="" type="text" name="vpc_Amount" value="4.5" size="20" maxlength="10" />
                                    </div>
                                    <div class="form-group div-noidia" id="amount-noidia">
                                        <label>Đơn vị tiền tệ</label>
                                        <select name="vpc_Currency" class="form-control">
                                            <option value="USD" selected="">USD</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-outline-accent m-btn m-btn--icon m-btn--outline-2x m-btn--pill m-btn--air" type="submit">
                                        <span>
                                            <span class="fa fa-money"></span> <span>Nạp tiền</span>
                                        </span>
                                    </button>
                                    <div class="bs-callout bs-callout-danger" style="margin-top: 30px;">
                                        <p>- Tỷ giá hiện tại giữa USD và VND là: <b>{{number_format($ty_gia,0)}} VND</b>.</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
