<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <title>Admin TrungLT - Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('images/ico/favicon.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/ico/favicon.png')}}">
        <link rel="manifest" href="{{url('images/ico/site.webmanifest')}}">
        <link rel="mask-icon" href="{{url('images/ico/safari-pinned-tab.svg')}}" color="#5bbad5">
        <link rel="shortcut icon" href="{{url('images/ico/favicon.ico')}}" type="image/x-icon">
        @include('layouts.admin.style')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('layouts.admin.header')
            @include('layouts.admin.sidebar')
            @yield('content')
            @include('layouts.admin.footer')
            @include('layouts.admin.script')
            <!-- Scripts -->
        </div>
    </body>
</html>