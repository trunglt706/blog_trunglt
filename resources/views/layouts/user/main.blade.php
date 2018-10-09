<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <title>Admin TrungLT - Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('images/ico/favicon.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/ico/favicon.png')}}">
        <link rel="shortcut icon" href="{{url('images/ico/favicon.ico')}}" type="image/x-icon">
        @include('layouts.user.style')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @if(auth()->user()->status != -1)
            @include('layouts.user.header')
            @include('layouts.user.sidebar')
            @yield('content')
            @include('layouts.user.footer')
            @include('layouts.user.script')
            @else
            @yield('content')
            @endif
            <!-- Scripts -->
        </div>
    </body>
</html>