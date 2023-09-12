<header class="header clearfix element_to_stick">
    <div class="layer"></div>
    <div class="container-fluid">
        <div id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('frontend/assets/img/twitter_header_photo_2.png') }}" width="140" height="35" alt=""
                    class="logo_normal">
                <img src="{{ asset('frontend/assets/img/twitter_header_photo_2.png') }}" width="140" height="35" alt=""
                    class="logo_sticky">
            </a>
        </div>
        <ul id="top_menu">
            <li><a href="#0" class="search-overlay-menu-btn"></a></li>
            @livewire('cart-icon-component')
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        @include('frontend.partials.navbar')
    </div>
</header>
