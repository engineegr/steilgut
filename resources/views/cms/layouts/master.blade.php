<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Steilgut CMS') }} CMS</title>

    <!-- Styles -->
    <link href="{{ mix('css/cms.css') }}" rel="stylesheet" />

    <!-- Scripts -->
    <script src="/libs/jquery-3.6.0.min.js"></script>

    <script src="{{ mix('js/cms.js') }}" defer></script>
    @yield('exp_head')
</head>

<body>
    <div id="cms-app" class="cms-app tw-flex tw-flex-col tw-flex-grow tw-h-auto tw-w-auto tw-bg-white">
        <nav class="cms-header navbar navbar-expand-md navbar-light tw-shadow-sm tw-z-10"
            style="background-color: rgba(153, 102, 0, 0.05);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Steilgut Laravel CMS') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#cmsNavbarSupportedContent" aria-controls="cmsNavbarSupportedContent"
                    aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="cmsNavbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav tw-mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav tw-ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="dropdown">
                                <a id="navbar-dropdown" class="btn dropdown-toggle" data-bs-toggle="dropdown" role="button">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('common.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="cms-main tw-py-2">
            <div class="container-fluid cms-main__messages tw-relative">
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger tw-absolute tw-w-full" role="alert">
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (isset($messages))
                    <div class="alert alert-success tw-absolute tw-w-full" role="alert">
                        <ul>
                            @foreach ($messages as $m)
                                <li>{{ $m }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
        <!-- Copyright -->
        <div class="cms-footer">
            <nav class="cms-lang-switch">
                <lang-switch-comp class="tw-px-4"></lang-switch-comp>
            </nav>
            <div
                class="cms-footer-signature tw-text-center tw-flex tw-flex-row tw-flex-grow tw-justify-end tw-items-center tw-mx-4">
                <h2 class="tw-pr-2">© 2021 Copyright:</h2>
                <a class="text-reset fw-bold tw-text-steilgut-text-gold"
                    href="https://steilgut.voodoopages.net/">Rockitin
                    Dev</a>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
@yield('exp_footer')

</html>
