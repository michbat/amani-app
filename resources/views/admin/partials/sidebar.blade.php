<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper m-5">
        <div class="sidebar-brand">
            <a href="{{ route('admin.index') }}">Data Management</a>
        </div>
        <div class="sidebar-brand sidebar-brand-lg">
            <a href="{{ route('admin.openClose') }}"
                class="text-dark btn {{ $global->opened === 1 ? 'btn-success' : 'btn-danger' }}">{{ $global->opened === 1 ? 'Ouvert' : 'Fermé' }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ route('admin.index') }}" class="nav-link"><i class="fas fa-home"></i><span>Index</span></a>
            </li>

            {{-- Section Rôles et Utilisateurs --}}

            <li class="menu-header">Rôles & Utilisateurs</li>

            <li class="dropdown {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-gavel"></i>
                    <span>Rôles</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.roles.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.roles.index') }}">Rôles</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-user-friends"></i>
                    <span>Utilisateurs</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-comment"></i>
                    <span>Commentaires</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.reviews.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.reviews.index') }}">Commentaires</a></li>
                </ul>
            </li>

            {{-- Section Commandes --}}

            <li class="menu-header">Commandes</li>

            <li class="dropdown {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-file-invoice"></i>
                    <span>Commandes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.orders.index') }}">Commandes</a></li>
                </ul>
            </li>

            {{-- Section Menus & Drinks --}}

            <li class="menu-header">Plats & Boissons</li>


            <li class="dropdown {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map"></i>
                    <span>Catégories de produits</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.categories.index') }}">Catégories de produits</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.plats.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-utensils"></i>
                    <span>Plats</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.plats.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.plats.index') }}">Plats</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.drinks.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-wine-bottle"></i>
                    <span>Boissons</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.drinks.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.drinks.index') }}">Boissons</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tags"></i>
                    <span>Tags</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.tags.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.tags.index') }}">Tags</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.types.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-seedling"></i>
                    <span>Types des ingrédients</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.types.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.types.index') }}">Types des ingrédients</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.units.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-weight"></i>
                    <span>Unités de mesure</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.units.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.units.index') }}">Unités de mesure</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.ingredients.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-apple-alt"></i>
                    <span>Ingredients</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.ingredients.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.ingredients.index') }}">Ingredients</a></li>
                </ul>
            </li>

            {{-- Section Spectacles --}}

            <li class="menu-header">Spectacles et programmations</li>
            <li class="dropdown {{ request()->routeIs('admin.shows.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-theater-masks"></i>
                    <span>Spectacles</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.shows.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.shows.index') }}">Spectacles</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.bands.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-drum"></i>
                    <span>Groupes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.bands.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.bands.index') }}">Groupes</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.representations.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="far fa-calendar-alt"></i>
                    <span>Représentations</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.representations.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.representations.index') }}">Représentations</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.musics.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-music"></i>
                    <span>Musiques</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.musics.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.musics.index') }}">Musiques</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.artists.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-microphone-alt"></i>
                    <span>Artistes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.artists.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.artists.index') }}">Artistes</a>
                    </li>
                </ul>
            </li>

            {{-- Section Restaurant --}}

            <li class="menu-header">Restaurant</li>

            <li class="dropdown {{ request()->routeIs('admin.restaurants.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-store"></i>
                    <span>Restaurant Info</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.restaurants.index') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.restaurants.index') }}">Restaurant Info</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.staffs.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-user-tie"></i>
                    <span>Staff</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.staffs.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.staffs.index') }}">Staff</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-video"></i>
                    <span>Galerie des médias</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.galleries.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.galleries.index') }}">Galerie des médias</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-film"></i>
                    <span>Sliders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.sliders.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.sliders.index') }}">Sliders</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.tables.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-table"></i>
                    <span>Tables</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.tables.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.tables.index') }}">Tables</a></li>
                </ul>
            </li>

        </ul>
    </aside>
</div>
