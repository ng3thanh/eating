<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        @include('web.assets.css')
        @yield('css')
        <link rel="shortcut icon" href="{{ asset('web/img/favicon.ico') }}">
    </head>

    <body>
        {{--@include('web.partials.header')--}}
        @yield('content')
        {{--@include('web.partials.footer')--}}
{{--        @include('web.partials.connect.phone')--}}
{{--        @include('web.partials.connect.facebook')--}}
        @include('web.assets.js')
        @yield('script')
    </body>
</html>
