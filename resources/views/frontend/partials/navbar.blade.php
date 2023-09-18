<nav class="main-menu">
    <div id="header_menu">
        <a href="#0" class="open_close">
            <i class="icon_close"></i><span>Menu</span>
        </a>
        <a href="{{ route('home') }}"><img src="{{ asset('frontend/assets/img/twitter_header_photo_2.png') }}"
                width="140" height="35" alt=""></a>
    </div>
    <ul>

        {{-- Seul le guest et un utilisateur autre que 'Generic' peuvent voir l'icône wishlist --}}

        @if (!auth()->user() || auth()->user()->firstname !== 'Generic')
            <li class="submenu">
                @livewire('wishlist-icon-component')
            </li>
        @endif
        @auth
            @if (Auth::user()->hasRole('admin'))
                <li class="submenu">
                    <a href="{{ route('admin.index') }}" class="show-submenu">Administrator</a>
                </li>
            @endif
            @if (Auth::user()->hasRole('personnel'))
                <li class="submenu">
                    <a href="{{ route('personnel.index') }}" class="show-submenu">Personnel</a>
                </li>
            @endif
            <li class="submenu">
                <a href="{{ route('user.dashboard') }}" class="show-submenu">Mon
                    compte</a>
            </li>
        @endauth
        <li class="submenu">
            <a href="{{ route('home') }}" class="show-submenu">Accueil</a>
        </li>
        <li class="submenu">
            <a href="{{ route('plat') }}" class="show-submenu">Plats</a>
        </li>
        <li class="submenu">
            <a href="{{ route('show') }}" class="show-submenu">Spectacles</a>
        </li>

        <li class="submenu">
            <a href="#" class="show-submenu">Galeries</a>
            <ul>
                <li><a href="{{ route('photo') }}"><i class="fas fa-camera mx-2"></i>Photos</a></li>
                <li><a href="{{ route('video') }}"><i class="fas fa-video mx-2"></i>Videos</a></li>
            </ul>
        </li>
        <li class="submenu">
            <a href="#" class="show-submenu">Contactez-nous</a>
        </li>

        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="btn btn-primary border border-primary border-3 text-white px-2 me-2" aria-current="page"
                        href="{{ route('login') }}">Connexion</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="btn btn-success border border-success border-3 text-white px-2"
                        href="{{ route('register') }}">Créer un compte</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="btn btn-outline-success dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Bonjour, {{ Auth::user()->firstname }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fas fa-user-alt mx-2"></i>
                        Mon Compte
                    </a>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mx-2"></i>Deconnexion
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>
