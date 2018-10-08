@component('mail::message')
Kính chào Quý khách <{{ $user->email }}>,

Quý khách đang thực hiện chức năng khôi phục mật khẩu. Nhấn vào link bên dưới để bắt đầu thực hiện chức năng này.<br/>
<a href="{{route('accept.reset.password', ['token' => $user->email_verified_at])}}?author={{$author}}" target="_blank">Khôi phục mật khẩu</a>

Mọi thắc mắc và góp ý xin Quý khách vui lòng liên hệ với chúng tôi qua:<br>
► Email hỗ trợ: blog.trunglt@gmail.com<br>
► Điện thoai: 0377 300 950

<b>KDATA</b> trân trọng cảm ơn và rất hân hạnh được phục vụ Quý khách.

<small>Đây là thư được gửi tự động, Quý khách vui lòng không trả lời thư này</small>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
