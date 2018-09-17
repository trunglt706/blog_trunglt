@component('mail::message')
<div class="row bgmain">
    <div class="col-md-12" style="background: #fff !important; padding: 20px; border-radius: 10px;">
        Kính gửi <b>{{$email}}</b>
        <p style="margin-bottom: 20px;">
            {{$noidung}}
        </p>
        <p style="margin-top: 20px;">
            Mọi chi tiết, Xin quý Đơn vị vui lòng xem tại:&nbsp;<a href="{{$urltrack}}?dot_gui_thu={{$newletter_id}}&nguoi_gui={{$user_id}}" target="_blank">Click để xem bài viết</a>
        </p>
    </div>
    <div class="col-md-12" style="border-top: 1px dotted; text-align: center; color: #000 !important;">
        <p style="font-weight: bold">PHÒNG XÚC TIẾN THƯƠNG MẠI VÀ ĐẦU TƯ - VCCI CHI NHÁNH CẦN THƠ CẦN THƠ</p>
        <p>
            - Đ/c: Số 12, đường Hòa Bình, P. An Cư, Q. Ninh Kiều, TP. Cần Thơ<br>
            - Điện thoại: 0292 3824 918 (117, 107)             - Fax: 0292 3824 169<br>
            - Email: hayama.akito19993/ nguyenphuong26193@gmail.com             - Website: http://www.vj-festival.com
        </p> <br/>
        <img src="{{url('images/ico/apple-touch-icon-180x180.png')}}" title="lễ hội việt nhật" alt="lễ hội việt nhật" width="250px"/> <br/>
    </div>
</div>
@endcomponent
