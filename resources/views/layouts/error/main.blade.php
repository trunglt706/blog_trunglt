<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.error.style')
    </head>
    <body>
        @yield('content')
        @include('layouts.error.script')
    </body>
</html>