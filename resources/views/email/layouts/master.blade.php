<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Steilgut CMS') }} Mail report</title>
    <!-- Styles -->
    <link href="{{ asset('css/mail.css') }}" rel="stylesheet" defer>
    @yield('exp_head')
</head>

<body>
    <div class="tw-flex mail-contatiner transit-flex-box">
        @yield('content')
    </div>
</body>
@yield('exp_footer')

</html>
