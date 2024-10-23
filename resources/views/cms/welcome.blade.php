<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Steilgut Laravel CMS</title>

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" defer>
</head>

<body class="antialiased">
    <div class="welcome-pg-body">
        <img src="/images/welcome-pg/xl/lg-bg-welcome.png" class="welcome-pg-bg-img" />
        <div class="welcome-pg-content justify-items-center align-items-center">
            @if (Route::has('login'))
                <div class="welcome-controls">
                    @auth
                        <div class="py-1 px-3 text-2xl">
                            <a href="{{ url('/home') }}" class="text-gray-400 hover:text-blue-400">Home</a>
                        </div>
                    @else
                        <div class="py-1 px-3 text-2xl">
                            <a href="{{ route('login') }}" class="text-gray-400 hover:text-blue-400">Login</a>
                        </div>

                        @if (Route::has('register'))
                            <div class="py-1 px-3 text-2xl">
                                <a href="{{ route('register') }}" class="text-gray-400 hover:text-blue-400">Register</a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            @endif
        </div>
    </body>

    </html>
