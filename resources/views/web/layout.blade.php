<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        @include('admin.assets.css')
        @yield('css')
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    </head>

    <body>

        @yield('content')
        @include('admin.assets.js')
        @yield('script')
    </body>
</html>
