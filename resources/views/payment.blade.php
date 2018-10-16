@extends('layouts.auth.main')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    {{trans('storage.recharge')}}
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
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#recharge_tab" role="tab">
                                        <i class="la la-newspaper-o"></i>
                                        Kênh thanh toán
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="recharge_tab">
                            <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                                <div class="m-portlet__body">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <div class="img-thanhtoan">
                                                <a href="{{route('payment.onepay')}}" title="Cổng thanh toán Onepay" target="_blank">
                                                    <img style="max-width: 200px;" class="img-responsive" src="/assets/images/logo-onepay.png" alt="Onepay"/>
                                                </a>
                                            </div>
                                            <p style="margin-top: 10px;">Kênh thanh toán Onepay</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20px;">
                                        <h5>THÔNG TIN TÀI KHOẢN THANH TOÁN:</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 alert alert-info m-alert m-alert--air m-alert--outline m-alert--outline-2x">
                                            1. Ngân Hàng Vietcombank – Chi Nhánh HCM<br/>
                                            - Số tài khoản: 0251001644525 <br/>
                                            - Chủ tài khoản: NGUYỄN VĂN CHI
                                        </div>
                                        <div class="col-md-6 alert alert-info m-alert m-alert--air m-alert--outline m-alert--outline-2x">
                                            2. Ngân hàng Vietcombank – Chi nhánh Kỳ Đồng, Quận 3, TP HCM<br/>
                                            - Số tài khoản: 0721000524823 <br/>
                                            - CÔNG TY TNHH KDATA<br/>
                                            - Tầng 5, Tòa nhà Trung Nam, 7A/80 Thành Thái, Phường 14, Quận 10, TP. HCM.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection