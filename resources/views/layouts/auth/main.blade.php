<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml"
      xmlns:og="http://ogp.me/ns#" itemscope="itemscope"
      itemtype="http://schema.org/WebPage">
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-language" content="vi,jp,en"/>
        <title>{{isset($object['title']) ? $object['title'] : $data['title']->value}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <link rel="apple-touch-icon" sizes="180x180" href="{{url('images/ico/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('images/ico/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/ico/favicon-16x16.png')}}">
        <link rel="manifest" href="{{url('images/ico/site.webmanifest')}}">
        <link rel="mask-icon" href="{{url('images/ico/safari-pinned-tab.svg')}}" color="#5bbad5">
        <link rel="shortcut icon" href="{{url('images/ico/favicon.ico')}}" type="image/x-icon">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        @include('layouts.auth.partials.seo')
        @include('layouts.auth.partials.author')
        @include('layouts.auth.partials.style')
        @include('layouts.auth.partials.script_header')
    </head>
    <body>
    <div id="wrapper">
        @include('layouts.auth.partials.header')
        @yield('content')
        @include('layouts.auth.partials.footer')
    </div>
    @include('layouts.auth.partials.script')
    </body>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-38058351-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-38058351-2');
    </script>
</html>