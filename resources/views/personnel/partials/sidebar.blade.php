<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper m-5">
        <div class="sidebar-brand">
            <a href="{{ route('personnel.index') }}">Data Management</a>
        </div>
        <div class="sidebar-brand sidebar-brand-lg">
            <a href="{{ route('personnel.openClose') }}"
                class="text-dark btn {{ $global->opened === 1 ? 'btn-success' : 'btn-danger' }}">{{ $global->opened === 1 ? 'Ouvert' : 'Fermé' }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ route('personnel.index') }}" class="nav-link"><i
                        class="fas fa-home"></i><span>Index</span></a>
            </li>

            {{-- Section Commandes --}}

            <li class="menu-header">Commandes</li>

            <li class="dropdown {{ request()->routeIs('personnel.orders.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-file-invoice"></i>
                    <span>Commandes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.orders.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.orders.index') }}">Commandes</a></li>
                </ul>
            </li>

            {{-- Section Menus & Drinks --}}

            <li class="menu-header">Plats & Boissons</li>


            <li class="dropdown {{ request()->routeIs('personnel.categories.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map"></i>
                    <span>Catégories de produits</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.categories.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.categories.index') }}">Catégories de
                            produits</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.plats.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-utensils"></i>
                    <span>Plats</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.plats.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.plats.index') }}">Plats</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.drinks.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-wine-bottle"></i>
                    <span>Boissons</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.drinks.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.drinks.index') }}">Boissons</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.tags.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tags"></i>
                    <span>Tags</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.tags.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.tags.index') }}">Tags</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.types.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-seedling"></i>
                    <span>Types des ingrédients</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.types.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.types.index') }}">Types des ingrédients</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.units.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-weight"></i>
                    <span>Unités de mesure</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.units.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.units.index') }}">Unités de mesure</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.ingredients.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-apple-alt"></i>
                    <span>Ingredients</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.ingredients.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.ingredients.index') }}">Ingredients</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.artists.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-microphone-alt"></i>
                    <span>Artistes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.artists.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.artists.index') }}">Artistes</a>
                    </li>
                </ul>
            </li>

            {{-- Section Spectacles --}}

            <li class="menu-header">Spectacles et programmations</li>
            <li class="dropdown {{ request()->routeIs('personnel.shows.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-theater-masks"></i>
                    <span>Spectacles</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.shows.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.shows.index') }}">Spectacles</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.bands.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-drum mx-2"></i>
                    <span>Groupes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.bands.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('personnel.bands.index') }}">Groupes</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.representations.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="far fa-calendar-alt"></i>
                    <span>Représentations</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.representations.index') ? 'active' : '' }}"><a
                            class="nav-link"
                            href="{{ route('personnel.representations.index') }}">Représentations</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.musics.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-music"></i>
                    <span>Musiques</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.musics.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.musics.index') }}">Musiques</a>
                    </li>
                </ul>
            </li>

            {{-- Section Restaurant --}}

            <li class="menu-header">Restaurant</li>

            <li class="dropdown {{ request()->routeIs('personnel.restaurants.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-store"></i>
                    <span>Restaurant Info</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.restaurants.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.restaurants.index') }}">Restaurant Info</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.staffs.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-user-tie"></i>
                    <span>Staff</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.staffs.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.staffs.index') }}">Staff</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.galleries.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-video"></i>
                    <span>Galerie des médias</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.galleries.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.galleries.index') }}">Galerie des médias</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.sliders.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-film"></i>
                    <span>Sliders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.sliders.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.sliders.index') }}">Sliders</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('personnel.tables.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-table"></i>
                    <span>Tables</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('personnel.tables.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('personnel.tables.index') }}">Tables</a></li>
                </ul>
            </li>

        </ul>
    </aside>
</div>
