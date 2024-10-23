<!-- resources/views/basic.blade.php -->
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title', 'Steilgut')</title>
    <meta name="description" content="steilgut" />
    <meta name="keywords" content="steilgut" />
    <link rel="shortcut icon" href="/images/icons/favicon.ico" type="images/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    @yield('exp_head')
</head>

<body>
    @yield('content')

    <div class="tail">
        @yield('tail')
    </div>
</body>

</html>
