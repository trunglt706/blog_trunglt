@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper">
    <!-- START PAGE HEADER -->
    <section class="inner-head" style="background-image: url(assets/images/faq-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title">THANH TOÁN NGÂN LƯỢNG</h1>
                    <p class="description">
                        Cổng thanh toán Ngân Lượng
                    </p>
                    <div class="breadcrumb">
                        <ul class="clearfix">
                            <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="ib"><a href="{{route('payment.index')}}">Thanh toán</a></li>
                            <li class="ib current-page">Ngân lượng</li>
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
                    <a href="{{route('payment.nganluong')}}" title="Cổng thanh toán Ngân lượng"><img src="{{url('images/payment-online/logoNL.png')}}" alt="Ngân lượng"/></a>
                </div>
                <div class="col-md-9">
                    <form class="m-form frm-payment" method="POST" action="{{ route('payment.recharge.nganluong') }}" role="form">
                        @csrf
                        <div class="form-group">
                            <label>Di động *</label>
                            <input type="text" class="form-control" required="" name="phone" placeholder="Nhập số di động ..."/>
                        </div>
                        <div class="form-group div-noidia">
                            <label>Số tiền *</label>
                            <input class="form-control" required="" type="number" name="amount" placeholder="Nhập số tiền ..." size="20" maxlength="10" />
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
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection