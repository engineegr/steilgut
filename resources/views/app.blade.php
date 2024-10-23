@extends('layouts.master')

@section('exp_head')
    <style>
        .app__loading__display {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 19;
            height: 100%;
            min-height: 100%;
            min-height: 100vh;
            min-height: calc(var(--100vh, 1vh) * 100);
            width: 100%;
            max-width: 100%;

            background-color: #b09a79;
            opacity: 0.4;
        }

        .app__loading__spinner {
            display: none;
            position: fixed;
            z-index: 20;
            top: 50%;
            left: 45%;
            width: min(max(30px, 7vh), 36px);
            height: min(max(30px, 7vh), 36px);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            border: solid #b09a79 2px;
            border-top: solid #af7977 2px;
            animation: spinner 3s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .app__loading__white_steilgut_pulse {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: url('/images/icons/pulse-logo/white-pulse-logo.png');
            background-size: contain;
            background-repeat: no-repeat;
            width: 185px;
            height: 130px;
            animation: pulse 5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%);
                opacity: 0.5;
            }

            50% {
                transform: translate(-50%, -50%) scale(2);
                opacity: 0.7;
            }

            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }

        .js-cookie-consent {
            opacity: 0;
        }

    </style>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    <link href="/css/fa-5.15.4.min.css" rel="stylesheet" />
    <script src="/libs/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://js.stripe.com/v3/" async></script> --}}

    <script type="text/javascript" defer>
        (function() {
            "use strict";
            if (!window.STEILGUT_VAR_STORE) {
                window.STEILGUT_VAR_STORE = {
                    STEILGUT_IMAGES: {
                        PRECAUTION_IMG: {},
                        MASTHEAD_BANNERS: {},
                        WINES: {
                            LEFT_WINE_IMG: {},
                            RIGHT_WINE_IMG: {},
                        },
                        SINGLE_WINE: {
                            SUDWAND_SINGLE_WINE_IMG: {},
                            SUDWAND_SINGLE_WINE_BOTTLE_IMG: {},
                            FRAUENBERG_SINGLE_WINE_IMG: {},
                            FRAUENBERG_SINGLE_WINE_BOTTLE_IMG: {},
                        },

                        LOGO_IMG: {},
                        MOBILE_MENU: {},
                        MENU_IMG: {},
                    },

                    INITIAL_STATE: {
                        WINES_PAGE: {!! json_encode($__INITIAL_STATE__['__WINES_PAGE_INITIAL_STATE__']) !!},
                    },

                    DEVICE_STATE: {
                        ORIENTATION_STATUS: "UNKNOWN",
                        IS_ORIENTATION_CHANGE_STARTED: false,
                        BODY_SCROLL_LOCK: null,
                        PLATFORM_TOOL: null,
                        ANDROID_FULLSCREEN_TOOL: null,
                        ORIGINAL_POTION: -1, // used to detect software keyboard
                    },
                };
            }
        })();

    </script>
    <script src="{{ mix('js/events.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
@endsection
@section('content')
    <div class="app__loading">
        <div class="app__loading__white_steilgut_pulse"></div>
        <div class="app__loading__spinner"></div>
        <button class="app__loading__display"></button>
        <script type="text/javascript">
            (function() {
                "use strict";
                $('.app__loading__display').fadeIn(3000, 'swing');
            })();

        </script>
    </div>
    <div id="app" v-cloak>
        <router-view></router-view>
    </div>
    {{-- For cookies acceptance: https://github.com/spatie/laravel-cookie-consent --}}
    @include('cookie-consent::index')
@endsection
