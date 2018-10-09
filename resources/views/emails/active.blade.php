@component('mail::message')
Xin chào {{ $name }},

Vui lòng nhấn vào button phía dưới để kích hoạt tài khoản tại <b style="color:#00ADEE;">Blog Trung</b>.

@component('mail::button', ['url' => route("user.active", $active_code)])
Kích hoạt tài khoản
@endcomponent

Thanks,<br>
{{ config('app.name') }}

<p style='background-color:#f3f3f3; text-align: center'><small> * Đây là thư được gửi tự động, Quý khách vui lòng không trả lời thư này *</small></p>

@endcomponent
