<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Data Management</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            {{-- <a href="#">AD</a> --}}
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i><span>Frontend</span></a>
            </li>

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

            <li class="menu-header">Menu</li>


            <li class="dropdown {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map"></i>
                    <span>Catégories de menu</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.categories.index') }}">Catégories de menu</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-utensils"></i>
                    <span>Menus</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.menus.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.menus.index') }}">Menus</a></li>
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
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-apple-alt"></i>
                    <span>Ingredients</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.ingredients.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.ingredients.index') }}">Ingredients</a></li>
                </ul>
            </li>

            <li class="menu-header">Restaurant Section</li>

            <li class="dropdown {{ request()->routeIs('admin.restaurants.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-store"></i>
                    <span>Restaurant Info</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.restaurants.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.restaurants.index') }}">Restaurant Info</a></li>
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


        </ul>
    </aside>
</div>
