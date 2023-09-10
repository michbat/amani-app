<nav class="main-menu">
    <div id="header_menu">
        <a href="#0" class="open_close">
            <i class="icon_close"></i><span>Menu</span>
        </a>
        <a href="index.html"><img src="{{ asset('frontend/assets/img/logo.svg') }}" width="140" height="35"
                alt=""></a>
    </div>
    <ul>

        <li class="submenu">
            @livewire('wishlist-icon-component')
        </li>
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
            <a href="{{ route('menu') }}" class="show-submenu">Menus</a>
        </li>
        {{-- <li class="submenu">
            <a href="{{ route('drink') }}" class="show-submenu">Boissons</a>
        </li> --}}

        <li class="submenu">
            <a href="#" class="show-submenu">Galerie</a>
            <ul>
                <li><a href="#">Photo</a></li>
                <li><a href="#">Video</a></li>
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
