@extends('layouts.auth.main')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <a href="{{route('payment')}}">{{trans('storage.recharge')}}</a> / Baokim.vn
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
                @if(isset($_GET['key']) &&($_GET['key'] == 'cancel'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    Bạn vừa hủy thao tác thanh toán thông qua baokim.vn!
                    @php unset($_GET['key']) @endphp
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
                        <img class="img-responsive img-circle" src="/assets/images/bk_logo.png" alt="Bảo Kim"/>
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
                                        Storage - Thanh toán trực tuyến thông qua Baokim.vn
                                    </h3>
                                </div>			
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                              <form class="m-form frm-payment" method="POST" action="{{ route('user.recharge.baokim') }}" style="width: 100%;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="m-portlet__body">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" required="" name="numberphone" value="{{ Auth::user()->phone }}"/>
                                    </div>
                                    <div class="form-group div-noidia">
                                        <label>Số tiền <small>(lớn hơn hoặc bằng 100.000 VND)</small></label>
                                        <input class="form-control" required="" type="text" name="vpc_Amount" value="100000" size="20" maxlength="10" />
                                    </div>
                                    <div class="form-group div-noidia" id="amount-noidia">
                                        <label>Đơn vị tiền tệ</label>
                                        <select name="vpc_Currency" class="form-control">
                                            <option value="VND" selected="">VNĐ</option>
                                        </select>
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
                                                <img src="{{url('assets/images/baokim/creditcard.png')}}" border="0"/>
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
                                                <img src="{{url('assets/images/baokim/transfer.png')}}" border="0"/><br>
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
                                                <img src="{{url('assets/images/baokim/atm.png')}}" border="0"/><br>
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
