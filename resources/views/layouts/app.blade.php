<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Foores - Single Restaurant Version">
    <meta name="author" content="Ansonika">
    <title>Hot Food - Single Restaurant Version</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('frontend/assets/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('frontend/assets/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital@1&amp;family=Poppins:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <!-- BASE CSS -->
    <link href="{{ asset('frontend/assets/css/vendors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('frontend/assets/css/wizard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/stripe3.css') }}">



    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('frontend/assets/css/custom.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Livewire CSS Styles -->
    @livewireStyles
</head>

<body>

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div>
    <!-- Sweetalert included  -->

    @include('sweetalert::alert')


    @include('frontend.partials.header')


    <main>
        @if (!Route::is('home'))
            <div class="hero_single inner_pages background-image"
                data-background="url({{ asset('frontend/assets/img/slider-3.jpg') }})">
                <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                    <div class="container">
                        <div class="row justify-content-center">
                            @yield('breadcrumb')
                        </div>
                    </div>
                </div>
                <div class="frame gray"></div>
            </div>
        @endif
        {{ $slot }}
    </main>

    @include('frontend.partials.footer')

    <div id="toTop"></div>

    <div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>,
                        mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus,
                        pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam
                        dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt
                        sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum
                        accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum
                        sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam
                        dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt
                        sensibus.</p>
                </div>
            </div>
        </div>
    </div>




    <!-- COMMON SCRIPTS -->

    <script src="{{ asset('frontend/assets/js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slider.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/common_func.js') }}"></script>
    <script src="{{ asset('frontend/assets/phpmailer/validate.js') }}"></script>


    <!-- SPECIFIC SCRIPTS (wizard form) -->

    <script src="{{ asset('frontend/assets/js/wizard/wizard_scripts.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wizard/wizard_func.js') }}"></script>

    <!-- SPECIFIC SCRIPTS -->

    <script src="{{ asset('frontend/assets/js/specific_shop.js') }}"></script>

    <!-- Livewire JS  -->

    @stack('scripts')
    @livewireScripts
</body>

</html>
