@extends('layouts.master')

@section('exp_head')
    {{-- <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('css/demo.css') }}" rel="stylesheet" /> --}}
    <link href="{{ mix('css/demo.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('css/fonts.css') }}" rel="stylesheet"> --}}
    {{-- <script src="https://use.fontawesome.com/2ba7753f9f.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    {{-- <script src="{{ asset('js/demo.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('build/js/body-scroll-lock/lib/bodyScrollLock.min.js') }}"></script> --}}
@endsection
@section('content')
    <div id="app">
        {{-- <div class="steilgut-masthead tw-absolute"> --}}
        {{-- <div class="steilgut-content tw-overflow-y-auto tw-relative"> --}}
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque est at orci venenatis, a semper
            est
            aliquam. Quisque rutrum convallis laoreet. Duis mattis tortor vel blandit posuere. Proin molestie tempor
            vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
            egestas.
            Duis
            aliquam ultricies aliquet. Cras in vulputate dui. Vestibulum faucibus auctor imperdiet. Curabitur
            aliquet
            placerat urna, et consectetur nisl. Nullam porttitor pulvinar elit, pretium faucibus ipsum pretium sit
            amet.
            Donec et erat non leo bibendum tempus laoreet vitae risus. Donec efficitur dui sit amet massa sodales,
            non</p>
        <p>Morbi vulputate facilisis ex, a venenatis risus elementum a. Pellentesque pharetra consequat consectetur.
            Morbi
            eleifend quam purus, et vehicula risus euismod a. Suspendisse scelerisque, sapien in sodales fermentum,
            augue
            erat fringilla nibh, at semper lacus eros vitae mauris. Aliquam vitae enim fringilla, faucibus tellus
            in,
            euismod ipsum. Donec eget eleifend dui, ac mattis lorem. Sed pharetra lobortis arcu, accumsan vestibulum
            ligula
            blandit id. Donec maximus finibus nisi, sed feugiat velit porttitor sed. Suspendisse molestie augue a ex
            auctor,
            non faucibus ex scelerisque. Phasellus maximus, sapien ut semper maximus, velit elit eleifend metus, sed
            vehicula sapien mi quis ligula. Nunc nisl est, tempor quis lorem eu, consequat congue felis. Curabitur a
            venenatis mi. Vivamus vitae sagittis sapien. Fusce et mi eu massa laoreet cursus. Etiam pharetra
            porttitor
            orci
            a placerat.</p>
        <p>Mauris ante neque, pretium id leo vitae, elementum sagittis nulla. Aliquam tincidunt nunc quis convallis
            euismod.
            Nulla at lorem nulla. Mauris tempus fermentum metus, quis egestas lectus congue eget. Etiam nisl dolor,
            condimentum sit amet ante non, maximus ultricies ante. Donec eleifend vulputate risus non vehicula.
            Aliquam
            lectus libero, condimentum quis orci semper, porttitor pulvinar ligula. Morbi pellentesque scelerisque
            erat
            at
            facilisis. Nunc luctus bibendum pulvinar. Duis lorem odio, tristique non ultrices non, semper ut ante.
            Sed
            rutrum eros iaculis odio pharetra, a condimentum quam commodo. Vestibulum eu tincidunt magna. Curabitur
            aliquet
            maximus lacus sit amet dapibus. Curabitur sit amet ex convallis, tincidunt lacus sit amet, lacinia nisl.
            Etiam
            laoreet mauris et pretium blandit. Pellentesque tincidunt rutrum lectus, nec tincidunt augue euismod at.
        </p>
        <p>Etiam convallis sodales nibh, a varius metus faucibus non. Ut consectetur sapien ante, vitae vestibulum
            turpis
            blandit a. Fusce lobortis malesuada arcu, eu euismod velit venenatis at. Vivamus bibendum leo non urna
            faucibus,
            tempor facilisis tellus gravida. Nulla gravida accumsan justo, non tristique justo facilisis quis. Sed
            at
            magna
            turpis. Maecenas feugiat ullamcorper sem eget aliquet. Duis cursus, diam vel porttitor semper, sem
            sapien
            commodo lectus, in porta leo magna eget tortor. Morbi justo dolor, efficitur eu tortor ac, consectetur
            auctor
            orci. Duis rutrum scelerisque mauris, vitae sodales libero cursus quis. Sed rutrum faucibus dolor, at
            mollis
            erat. Quisque ut mi nec tellus blandit maximus. Aliquam malesuada porta eros, et mattis risus elementum
            eget.
        </p>
        <p>Mauris ut erat vel odio sodales mattis quis id ante. Nullam sit amet nunc sit amet nisi maximus feugiat.
            Proin
            tincidunt sodales dictum. Mauris volutpat, justo id tincidunt finibus, magna metus laoreet mauris, a
            semper
            dolor sem sit amet lacus. Nulla vitae ultrices purus. Fusce tempor tristique risus, molestie dictum
            ligula
            pulvinar porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vehicula neque lectus, ut
            luctus
            nisi sagittis ac. Curabitur porttitor lacus nibh, quis hendrerit nibh semper ac. Donec nec lectus id
            lectus
            vulputate luctus. Morbi tempus hendrerit massa nec malesuada. Mauris sodales sem eleifend felis auctor
            vehicula.
            Phasellus pellentesque faucibus elit id porta. Nullam congue nibh et orci euismod, ac molestie dui
            mattis.
            Morbi
            tincidunt lacus nec turpis aliquet varius. Vestibulum congue tristique enim.</p>
        {{-- </div> --}}
        {{-- </div> --}}
    </div>
    {{-- <div id="brim-main">
        <div class="wrapper">
            <p>Hello, I am the <b>main</b> element.</p>
            <p>When in the portrait orientation, there is a remaining chrome at the top. Changing the document background
                color will change the shade of the remaining chrome.</p>
            <p><b>Tap the top of the screen to leave the minimal-ui.</b></p>
            <p>The rest of the content is to enable scrolling testing.</p>
            <p>END of BRIM-MAIN</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque est at orci venenatis, a semper est
                aliquam. Quisque rutrum convallis laoreet. Duis mattis tortor vel blandit posuere. Proin molestie tempor
                vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                Duis
                aliquam ultricies aliquet. Cras in vulputate dui. Vestibulum faucibus auctor imperdiet. Curabitur aliquet
                placerat urna, et consectetur nisl. Nullam porttitor pulvinar elit, pretium faucibus ipsum pretium sit amet.
                Donec et erat non leo bibendum tempus laoreet vitae risus. Donec efficitur dui sit amet massa sodales, non
                tempus nisl dapibus. Nulla consequat mi in odio tristique ornare.</p>
            <p>Morbi vulputate facilisis ex, a venenatis risus elementum a. Pellentesque pharetra consequat consectetur.
                Morbi
                eleifend quam purus, et vehicula risus euismod a. Suspendisse scelerisque, sapien in sodales fermentum,
                augue
                erat fringilla nibh, at semper lacus eros vitae mauris. Aliquam vitae enim fringilla, faucibus tellus in,
                euismod ipsum. Donec eget eleifend dui, ac mattis lorem. Sed pharetra lobortis arcu, accumsan vestibulum
                ligula
                blandit id. Donec maximus finibus nisi, sed feugiat velit porttitor sed. Suspendisse molestie augue a ex
                auctor,
                non faucibus ex scelerisque. Phasellus maximus, sapien ut semper maximus, velit elit eleifend metus, sed
                vehicula sapien mi quis ligula. Nunc nisl est, tempor quis lorem eu, consequat congue felis. Curabitur a
                venenatis mi. Vivamus vitae sagittis sapien. Fusce et mi eu massa laoreet cursus. Etiam pharetra porttitor
                orci
                a placerat.</p>
            <p>Mauris ante neque, pretium id leo vitae, elementum sagittis nulla. Aliquam tincidunt nunc quis convallis
                euismod.
                Nulla at lorem nulla. Mauris tempus fermentum metus, quis egestas lectus congue eget. Etiam nisl dolor,
                condimentum sit amet ante non, maximus ultricies ante. Donec eleifend vulputate risus non vehicula. Aliquam
                lectus libero, condimentum quis orci semper, porttitor pulvinar ligula. Morbi pellentesque scelerisque erat
                at
                facilisis. Nunc luctus bibendum pulvinar. Duis lorem odio, tristique non ultrices non, semper ut ante. Sed
                rutrum eros iaculis odio pharetra, a condimentum quam commodo. Vestibulum eu tincidunt magna. Curabitur
                aliquet
                maximus lacus sit amet dapibus. Curabitur sit amet ex convallis, tincidunt lacus sit amet, lacinia nisl.
                Etiam
                laoreet mauris et pretium blandit. Pellentesque tincidunt rutrum lectus, nec tincidunt augue euismod at.</p>
            <p>Etiam convallis sodales nibh, a varius metus faucibus non. Ut consectetur sapien ante, vitae vestibulum
                turpis
                blandit a. Fusce lobortis malesuada arcu, eu euismod velit venenatis at. Vivamus bibendum leo non urna
                faucibus,
                tempor facilisis tellus gravida. Nulla gravida accumsan justo, non tristique justo facilisis quis. Sed at
                magna
                turpis. Maecenas feugiat ullamcorper sem eget aliquet. Duis cursus, diam vel porttitor semper, sem sapien
                commodo lectus, in porta leo magna eget tortor. Morbi justo dolor, efficitur eu tortor ac, consectetur
                auctor
                orci. Duis rutrum scelerisque mauris, vitae sodales libero cursus quis. Sed rutrum faucibus dolor, at mollis
                erat. Quisque ut mi nec tellus blandit maximus. Aliquam malesuada porta eros, et mattis risus elementum
                eget.
            </p>
            <p>Mauris ut erat vel odio sodales mattis quis id ante. Nullam sit amet nunc sit amet nisi maximus feugiat.
                Proin
                tincidunt sodales dictum. Mauris volutpat, justo id tincidunt finibus, magna metus laoreet mauris, a semper
                dolor sem sit amet lacus. Nulla vitae ultrices purus. Fusce tempor tristique risus, molestie dictum ligula
                pulvinar porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vehicula neque lectus, ut
                luctus
                nisi sagittis ac. Curabitur porttitor lacus nibh, quis hendrerit nibh semper ac. Donec nec lectus id lectus
                vulputate luctus. Morbi tempus hendrerit massa nec malesuada. Mauris sodales sem eleifend felis auctor
                vehicula.
                Phasellus pellentesque faucibus elit id porta. Nullam congue nibh et orci euismod, ac molestie dui mattis.
                Morbi
                tincidunt lacus nec turpis aliquet varius. Vestibulum congue tristique enim.</p>
        </div>
    </div>
    <div id="brim-mask">
        <p>START of BRIM-MASK</p>
        <p>Hello, I am the <b>mask</b> element.</p>
        <p>My purpose is to hide the <b>main</b> element when browser is not in the minimal view and give user
            instructions how to enter the minimal view.</p>
        <p>Behind me is the <b>treadmill</b> element. It has been generated dynamically. It is used to give user plenty
            of space to scroll down.</p>
        <p>Scroll down to hide me.</p>
    </div>
    <div id="not-ios-8">
        <p>This demo has been designed for iOS 8.</p>
        <label class="field-title-text" for="email">
            Email
        </label>
        <input type="text" class="user-field tw-appearance-none focus:tw-outline-none" name="email" placeholder="test@ya.ru"
            maxlength="33" />
    </div> --}}
@endsection
@section('tail')
    <script type="text/javascript">
        // const bodyScrollLock = require('body-scroll-lock');
        const disableBodyScroll = bodyScrollLock.disableBodyScroll;
        const enableBodyScroll = bodyScrollLock.enableBodyScroll;

        const appDOMElement = document.querySelector('#app');
        disableBodyScroll(appDOMElement);
        window.scrollTo({
            top: -46,
            left: 0,
            behavior: "smooth"
        });

    </script>
@endsection
