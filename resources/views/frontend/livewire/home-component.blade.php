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
                                            <div class="owl-slide-animated owl-slide-cta">
                                                @if ($slider->id != 4)
                                                    <a class="btn btn-success" href="{{ route('plat') }}" role="button"
                                                        style="min-width: 200px">Notre Carte</a>
                                                @else
                                                    <a class="btn btn-success" href="{{ route('show') }}" role="button"
                                                        style="min-width: 200px">Spectacles</a>
                                                @endif
                                            </div>
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
            @if ($global && $global->opened == 0)
                <p style="color: red; font-size: 23px; text-align: center;">Restaurant fermé! PAS DE COMMANDES!!!</p>
            @endif
            <div class="row justify-content-center d-flex align-items-center">
                <div class="col-lg-5 text-lg-center d-none d-lg-block" data-cue="slideInUp">
                    <figure>
                        @if ($video)
                            <img src="#" data-src="http://img.youtube.com/vi/{{ $video->videoId }}/0.jpg"
                                width="354" height="440" alt="" class="img-fluid lazy">
                            <a href="https://www.youtube.com/watch?v={{ $video->videoId }}" class="btn_play"
                                data-cue="zoomIn" data-delay="500"><span class="pulse_bt"><i
                                        class="arrow_triangle-right"></i></span></a>
                        @endif
                    </figure>
                </div>
                <div class="col-lg-5 pt-lg-4">
                    <div class="main_title">
                        <span style="background-color: green!important"><em
                                style="background-color: green!important"></em></span>
                        <h2>À propos de nous</h2>
                    </div>
                    @if ($global)
                        <p>{!! $global->aboutUs !!}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="bg_gray">
        <div class="container margin_120_100" data-cue="slideInUp">
            <div class="main_title center mb-5">
                <span style="background-color: green!important"><em
                        style="background-color: green!important"></em></span>
                <h2>À la carte</h2>
            </div>
            <div class="row homepage add_bottom_25">
                <div class="col-xl-12">
                    <div class="row">
                        @if (count($plats) > 0)
                            @foreach ($plats as $plat)
                                <div class="col-lg-6">
                                    <div class="menu_item">
                                        <figure class="magnific-gallery" data-cue="slideInUp">
                                            <a href="{{ $plat->image }}" title="{{ $plat->name }}"
                                                data-effect="mfp-zoom-in">
                                                <img src="{{ asset($plat->image) }}"
                                                    data-src="{{ asset($plat->image) }}" class="lazy"
                                                    alt="{{ $plat->name }}">
                                            </a>
                                        </figure>
                                        <div class="menu_title">
                                            <a href="{{ route('details', $plat->slug) }}">
                                                <h3>{{ $plat->name }} <span class="text-danger"
                                                        style="font-size: 12px">{{ $plat->available === 0 ? 'indisponible' : '' }}</span>
                                                </h3>
                                            </a>
                                            <em style="background-color: rgb(67, 139, 67)!important">
                                                {{ $plat->price }} &euro;
                                            </em>
                                        </div>
                                        <p>{!! str()->limit($plat->description, 100) !!}</p>
                                        <a class="btn btn-success {{ $plat->available === 0 || $plat->canBeCommended === 0 || $global->opened === 0 ? 'disabled' : '' }}"
                                            href="#"
                                            wire:click.prevent="storePlat({{ $plat->id }},'{{ $plat->name }}',{{ $plat->price }})"><i
                                                class="fas fa-shopping-cart mx-2"></i>Ajouter</a>
                                    </div>
                                </div>
                            @endforeach

                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->
    <div class="container margin_120_100">
        <div class="main_title center mb-5">
            <span style="background-color: green!important">
                <em style="background-color: green!important"></em>
            </span>
            <h2>Nos chefs et staff</h2>
        </div>
        <div id="staff" class="owl-carousel owl-theme">
            @foreach ($staffs as $staff)
                <div class="item">
                    <div class="title">
                        <h4>{{ $staff->name }}<em>{{ $staff->fonction }}</em></h4>
                    </div><img src="{{ asset($staff->image) }}" alt="{{ $staff->name }}" width="350"
                        height="500">
                </div>
            @endforeach

        </div>
        <!-- /carousel -->
    </div>
    <div class="call_section lazy">
    </div>
</div>
