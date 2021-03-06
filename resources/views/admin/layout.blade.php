<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @include('admin.assets.css')
    @yield('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper" id="app">
        @include('admin.partials.header')
        @include('admin.partials.sidebar')

        <div class="content-wrapper">
            @include('admin.partials.notification')
            @include('admin.partials.breadcrumb')
            @yield('content')
        </div>

        @include('admin.partials.footer')
        @include('admin.partials.control_sidebar')
    </div>

    @include('admin.assets.js')
    @yield('script')
</body>
</html>