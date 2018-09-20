<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <title>Trang quản lý - [Lễ hội Việt - Nhật {{date("Y")}}]</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <link rel="apple-touch-icon" sizes="180x180" href="{{url('images/ico/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('images/ico/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/ico/favicon-16x16.png')}}">
        <link rel="manifest" href="{{url('images/ico/site.webmanifest')}}">
        <link rel="mask-icon" href="{{url('images/ico/safari-pinned-tab.svg')}}" color="#5bbad5">
        <link rel="shortcut icon" href="{{url('images/ico/favicon.ico')}}" type="image/x-icon">
        @include('layouts.admin.style')
    </head>
    <body class="pace-done skin-black">
        @include('layouts.admin.header')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            @include('layouts.admin.sidebar')
            @yield('content')
        </div>
        @include('layouts.admin.footer')
        @include('layouts.admin.script')
        <!-- Scripts -->        
    </body>
</html>