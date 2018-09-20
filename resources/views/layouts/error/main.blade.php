<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.auth.partials.style')
    </head>
    <body>
        @yield('content')
        @include('layouts.auth.partials.script')
    </body>
</html>