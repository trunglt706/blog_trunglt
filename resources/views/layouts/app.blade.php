<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin TrungLT | Login</title>
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
        <!-- iCheck -->
        <link href="{{url('plugin/iCheck/square/blue.css')}}" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        @yield('content')
        <!-- jQuery 3 -->
        <script src="{{url('js/admin/jquery.min.js'.'?v='.env("APP_VERSION"))}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{url('js/admin/bootstrap.min.js'.'?v='.env("APP_VERSION"))}}"></script>
        <!-- iCheck -->
        <script src="{{url('plugin/iCheck/icheck.min.js'.'?v='.env("APP_VERSION"))}}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
        </script>
    </body>
</html>