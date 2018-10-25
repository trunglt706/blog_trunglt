<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ isset($author) ? 'Admin TrungLT' : 'User' }} | Login</title>
        <link rel="icon" type="image/png" href="{{url('images/login-icon.png')}}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link href="{{url('css/admin/bootstrap.min.css')}}" rel="stylesheet" />
        <!-- Font Awesome -->
        <link href="{{url('css/admin/font-awesome.min.css')}}" rel="stylesheet" />
        <!-- Ionicons -->
        <link href="{{url('css/admin/ionicons.min.css')}}" rel="stylesheet" />
        <!-- Theme style -->
        <link href="{{url('css/admin/AdminLTE.min.css')}}" rel="stylesheet" />
        <style>
            body { background-image: url("{{url('images/error/error-bg.PNG')}}") !important;}
        </style>
        {!! NoCaptcha::renderJs() !!}
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        @yield('content')
        <!-- jQuery 3 -->
        <script src="{{url('js/admin/jquery.min.js'.'?v='.env("APP_VERSION"))}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{url('js/admin/bootstrap.min.js'.'?v='.env("APP_VERSION"))}}"></script>
    </body>
</html>