<header class="header clearfix element_to_stick">
    <div class="layer"></div>
    <div class="container-fluid">
        <div id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('frontend/assets/img/logo_1.png') }}" width="140" height="35" alt=""
                    class="logo_normal">
                <img src="{{ asset('frontend/assets/img/logo_2.png') }}" width="140" height="35" alt=""
                    class="logo_sticky">
            </a>
        </div>
        <ul id="top_menu">
            <li>
                <a href="#0" class="search-overlay-menu-btn">
                    {{-- <i class="fas fa-search"></i> --}}
                </a>
            </li>
            @livewire('cart-icon-component')
        </ul>
        <!-- /top_menu -->
        <a href="#" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        @include('frontend.partials.navbar')
    </div>
    <!-- Search -->
    {{-- <div class="search-overlay-menu">
        <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_search"></i></button>
        </form>
    </div> --}}
    <!-- End Search -->
</header>
