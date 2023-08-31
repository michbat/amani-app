<div>
    <div id="carousel-home">
        <div class="owl-carousel owl-theme">
            @if (count($sliders) > 0)
                @foreach ($sliders as $slider)
                    <div class="owl-slide cover lazy" data-bg="url({{ asset($slider->image) }})">
                        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 m-auto static">
                                        <div class="slide-text white text-center">
                                            <h2 class="owl-slide-animated owl-slide-title">{{ $slider->title }}</h2>
                                            <p class="owl-slide-animated owl-slide-subtitle">
                                                {!! $slider->content !!}
                                            </p>
                                            <div class="owl-slide-animated owl-slide-cta"><a class="btn btn-success"
                                                    href="{{ route('menu') }}" role="button">Notre menu</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div id="icon_drag_mobile"></div>
    </div>

    <div class="pattern_2">
        <div class="container margin_120_100 home_intro">
            <div class="row justify-content-center d-flex align-items-center">
                <div class="col-lg-5 text-lg-center d-none d-lg-block" data-cue="slideInUp">
                    <figure>
                        <img src="#" data-src="http://img.youtube.com/vi/{{ $video->videoId }}/0.jpg"
                            width="354" height="440" alt="" class="img-fluid lazy">
                        <a href="https://www.youtube.com/watch?v={{ $video->videoId }}" class="btn_play"
                            data-cue="zoomIn" data-delay="500"><span class="pulse_bt"><i
                                    class="arrow_triangle-right"></i></span></a>
                    </figure>
                </div>
                <div class="col-lg-5 pt-lg-4">
                    <div class="main_title">
                        <span style="background-color: green!important"><em
                                style="background-color: green!important"></em></span>
                        <h2>À propos de nous</h2>
                    </div>
                    <p>{!! $restaurant->aboutUs !!}</p>
                </div>
            </div>
        </div>
    </div>


    <section class="container margin_120_100">
        <div class="row">
            <div class="col-xl-3">
                <a href="#" class="img_container">
                    <img src="{{ asset('frontend/assets/img/banner_1.jpg') }}" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Menu à la carte</h3>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="#" class="img_container">
                    <img src="{{ asset('frontend/assets/img/banner_3.jpg') }}" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Nos vidéos</h3>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="#" class="img_container">
                    <img src="{{ asset('frontend/assets/img/banner_3.jpg') }}" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Nos photos</h3>
                    </div>
                </a>
            </div>

            <div class="col-xl-3">
                <!-- seul des utilisateurs disposant un compte peuvent réserver une table. Un visiteur est directement dirigé vers la page de login  -->
                <a href="{{ auth()->user() === null ? route('login') : route('home') }}" class="img_container">
                    <img src="{{ asset('frontend/assets/img/banner_5.jpg') }}" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Reservez une table</h3>
                    </div>
                </a>
            </div>

            <div class="col-xl-3">
                <a href="#" class="img_container">
                    <img src="{{ asset('frontend/assets/img/banner_1.jpg') }}" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Spectacles</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>


    <div class="bg_gray">
        <div class="container margin_120_100" data-cue="slideInUp">
            <div class="main_title center mb-5">
                <span style="background-color: green!important"><em
                        style="background-color: green!important"></em></span>
                <h2>Menu à la carte</h2>
            </div>
            <div class="row homepage add_bottom_25">
                <div class="col-xl-12">
                    <div class="row">
                        @if (count($menus) > 0)
                            @foreach ($menus as $menu)
                                <div class="col-lg-6">
                                    <div class="menu_item">
                                        <figure class="magnific-gallery" data-cue="slideInUp">
                                            <a href="{{ $menu->image }}" title="{{ $menu->name }}"
                                                data-effect="mfp-zoom-in">
                                                <img src="{{ asset($menu->image) }}"
                                                    data-src="{{ asset($menu->image) }}" class="lazy"
                                                    alt="{{ $menu->name }}">
                                            </a>
                                        </figure>
                                        <div class="menu_title">
                                            <a href="{{ route('details', $menu->slug) }}">
                                                <h3>{{ $menu->name }} <span class="text-danger"
                                                        style="font-size: 12px">{{ $menu->available === 0 ? 'indisponible' : '' }}</span>
                                                </h3>
                                            </a>
                                            <em style="background-color: rgb(67, 139, 67)!important">
                                                {{ $menu->price }} &euro;
                                            </em>
                                        </div>
                                        <p>{!! str()->limit($menu->description, 100) !!}</p>
                                        <a class="btn btn-success {{ $menu->available === 0 ? 'disabled' : '' }}"
                                            href="#"
                                            wire:click.prevent="storeMenu({{ $menu->id }},'{{ $menu->name }}',{{ $menu->price }})"><i
                                                class="fas fa-shopping-cart mx-2"></i>Ajouter</a>
                                    </div>
                                </div>
                            @endforeach

                        @endif
                    </div>
                </div>
            </div>
            <!-- /row -->
            <p class="text-center"><a href="#0" class="btn btn-outline-success px-3" data-cue="zoomIn">Download
                    Menu (PDF)</a>
            </p>
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="call_section lazy">
    </div>
</div>
