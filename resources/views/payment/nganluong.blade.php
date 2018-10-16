@extends('layouts.auth.main')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <a href="{{route('payment')}}">{{trans('storage.recharge')}}</a> / Nganluong.vn
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
                    Bạn vừa hủy thao tác thanh toán thông qua nganluong.vn!
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
                        <img class="img-responsive img-circle" src="/assets/images/logoNL.png" alt="Ngân lượng"/>
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
                                        Storage - Thanh toán trực tuyến thông qua Nganluong.vn
                                    </h3>
                                </div>			
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row">
                            <form class="m-form frm-payment" method="POST" action="{{ route('user.recharge.nganluong') }}" style="width: 100%;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="m-portlet__body">
                                    <div class="form-group">
                                        <label>Di động</label>
                                        <input type="text" class="form-control" required="" name="phone" value="{{ Auth::user()->phone }}"/>
                                    </div>
                                    <div class="form-group div-noidia">
                                        <label>Số tiền <small>(lớn hơn hoặc bằng 100.000 VND)</small></label>
                                        <input class="form-control" required="" type="text" name="vpc_Amount" value="100000" size="20" maxlength="10" />
                                    </div>
                                    <ul class="list-content">
                                        <li class="active li-head">
                                            <label>
                                                <input type="radio" value="NL" checked="" name="option_payment" selected="true">Thanh toán bằng Ví điện tử NgânLượng
                                            </label>
                                            <div class="boxContent">
                                                <p>
                                                    Đăng ký ví Ngân lượng miễn phí tại <a href="https://www.nganluong.vn/nganluong/userRegister/index.html" target="_blank">nganluong.vn</a> nếu chưa có tài khoản.
                                                </p>
                                            </div>
                                        </li>
                                        <li class=" li-head">
                                            <label>
                                                <input type="radio" value="ATM_ONLINE" name="option_payment">Thanh toán online bằng thẻ ngân hàng nội địa
                                            </label>
                                            <div class="boxContent">
                                                <p>
                                                    <i>
                                                        <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.
                                                    </i>
                                                </p>
                                                <ul class="cardList clearfix">
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                            <input class="form-control bidv_input" type="radio" value="BIDV"  name="bankcode">
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                            <input class="form-control" type="radio" value="VCB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vnbc_ck_on">
                                                            <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                            <input class="form-control" type="radio" value="DAB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="tcb_ck_on">
                                                            <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                            <input class="form-control" type="radio" value="TCB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_mb_ck_on">
                                                            <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                            <input class="form-control" type="radio" value="MB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vib_ck_on">
                                                            <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                                            <input class="form-control" type="radio" value="VIB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vtb_ck_on">
                                                            <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                            <input class="form-control" type="radio" value="ICB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_exb_ck_on">
                                                            <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
                                                            <input class="form-control" type="radio" value="EXB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_acb_ck_on">
                                                            <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                            <input class="form-control" type="radio" value="ACB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_hdb_ck_on">
                                                            <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
                                                            <input class="form-control" type="radio" value="HDB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_msb_ck_on">
                                                            <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                            <input class="form-control" type="radio" value="MSB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_nvb_ck_on">
                                                            <i class="NVB" title="Ngân hàng Nam Việt"></i>
                                                            <input class="form-control" type="radio" value="NVB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vab_ck_on">
                                                            <i class="VAB" title="Ngân hàng Việt Á"></i>
                                                            <input class="form-control" type="radio" value="VAB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_vpb_ck_on">
                                                            <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
                                                            <input class="form-control" type="radio" value="VPB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_scb_ck_on">
                                                            <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                            <input class="form-control" type="radio" value="SCB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_pgb_ck_on">
                                                            <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                            <input class="form-control" type="radio" value="PGB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_gpb_ck_on">
                                                            <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
                                                            <input class="form-control" type="radio" value="GPB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_agb_ck_on">
                                                            <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                            <input class="form-control" type="radio" value="AGB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="bnt_atm_sgb_ck_on">
                                                            <i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
                                                            <input class="form-control" type="radio" value="SGB"  name="bankcode" >
                                                        </label>
                                                    </li>	
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="BAB" title="Ngân hàng Bắc Á"></i>
                                                            <input class="form-control" type="radio" value="BAB"  name="bankcode" >

                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="TPB" title="Tền phong bank"></i>
                                                            <input class="form-control" type="radio" value="TPB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="NAB" title="Ngân hàng Nam Á"></i>
                                                            <input class="form-control" type="radio" value="NAB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                                            <input type="radio" value="SHB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="sml_atm_bab_ck_on">
                                                            <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
                                                            <input class="form-control" type="radio" value="OJB"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class=" li-head">
                                            <label>
                                                <input type="radio" value="VISA" name="option_payment" selected="true">Thanh toán bằng thẻ Visa hoặc MasterCard
                                            </label>
                                            <div class="boxContent">
                                                <p><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>:Visa hoặc MasterCard.</p>
                                                <ul class="cardList clearfix">
                                                    <li class="bank-online-methods ">
                                                        <label for="vcb_ck_on">
                                                            <i class="VISA" title="VISA"></i>
                                                            <input class="form-control visa_input" type="radio" value="VISA"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                    <li class="bank-online-methods ">
                                                        <label for="vnbc_ck_on">
                                                            <i class="MASTE" title="MASTER"></i>
                                                            <input class="form-control" type="radio" value="MASTER"  name="bankcode" >
                                                        </label>
                                                    </li>
                                                </ul>	
                                            </div>
                                        </li>
                                    </ul>
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