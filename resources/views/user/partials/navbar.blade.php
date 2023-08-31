<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Amani Resto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="btn btn-success  @if (request()->routeIs('admin.index')) active @endif mx-3"
                                href="{{ route('admin.index') }}">Administrator</a>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('personnel'))
                        <li class="nav-item">
                            <a class="btn btn-success @if (request()->routeIs('personnel.index')) active @endif"
                                href="{{ route('personnel.index') }}">Personnel</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active mx-2" aria-current="page" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active mx-2" aria-current="page" href="{{ route('menu') }}">Menu</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mx-2" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Medias
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Photo</a></li>
                        <li><a class="dropdown-item" href="#">Vidéo</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active mx-2" aria-current="page" href="#">Contact Us</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-primary me-2" aria-current="page" href="{{ route('login') }}">Connexion</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-success" href="{{ route('register') }}">Créer un compte</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Hello, {{ Auth::user()->firstname }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                Mon Compte
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Deconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
