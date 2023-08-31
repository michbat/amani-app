@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Menu</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<div>
    <main>
        <div class="filters_full clearfix">
            <div class="container d-flex justify-content-between">
                <div class="count_results">
                    @if ($menus->count() > 0)
                        <p>{{ $menus->firstItem() }} à {{ $menus->lastItem() }} sur {{ $menus->total() }} item(s)</p>
                    @endif
                </div>
                <div>
                    <select name="page" class="form-control" style="min-width: 150px" wire:model="pageItems">
                        <option value="4">4 items</option>
                        <option value="8">8 items</option>
                        <option value="12">12 items</option>
                        <option value="16">16 items</option>
                        <option value="20">20 items</option>
                    </select>
                </div>
                <div class="sort_select">
                    <select wire:model="orderBy">
                        <option value="default">Par défaut</option>
                        {{-- <option value="rating">Mieux noté</option> --}}
                        <option value="new">Nouveauté</option>
                        <option value="ascendant">Prix croissant</option>
                        <option value="descendant">Prix décroissant</option>
                    </select>
                </div>
                <a href="#collapseFilters" data-bs-toggle="collapse" class="btn_filters"><i
                        class="icon_adjust-vert"></i><span>Filters</span></a>
            </div>
        </div>
        <!-- /filters_full -->
        <div class="collapse filters_2" id="collapseFilters">
            <div class="container margin_detail">
                <div class="row">
                    <div class="col-md-4">
                        <div class="filter_type">
                            <h6>Categories</h6>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <label class="container_check">{{ $category->designation }}
                                            <small>{{ $category->menus->count() }}</small>
                                            <input wire:model="cats" value="{{ $category->designation }}"
                                                type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="filter_type">
                            <h6>Rating</h6>
                            <ul>
                                <li>
                                    <label class="container_check">Superb 9+ <small>06</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Very Good 8+ <small>12</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Good 7+ <small>17</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">Pleasant 6+ <small>43</small>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="filter_type">
                            <h6>Price</h6>
                            <ul>
                                <li>
                                    <label class="container_check">0&euro; — 5&euro;<small>11</small>
                                        <input wire:model="priceIntervals" value="0-5" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">5&euro; — 10&euro;<small>08</small>
                                        <input wire:model="priceIntervals" value="5-10" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">10&euro; — 15&euro;<small>05</small>
                                        <input wire:model="priceIntervals" value="10-15" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">15&euro; — 20&euro;<small>18</small>
                                        <input wire:model="priceIntervals" value="15-20" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">20&euro; — 25&euro;<small>18</small>
                                        <input wire:model="priceIntervals" value="20-25" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            priceIntervals:{{ print_r($priceIntervals) }}
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /filters -->
        <div class="pattern_2">
            <div class="container margin_60_40">
                {{-- @if ($message = Session::get('success_message'))
                    <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}
                <div class="main_title center">
                    <span style="background-color: green!important"><em
                            style="background-color: green!important"></em></span>

                    <!-- Si il n'y a aucun filtrage par catégorie, on affichage toutes les catégories  -->
                    @empty($cats)
                        <h2 class="mb-3">Entrées, Plats principaux, Desserts, Boissons</h2>
                    @else
                        @foreach ($cats as $cat)
                            <h2 class="mb-3" style="display: inline-block">{{ $cat }},</h2>
                        @endforeach
                    @endempty
                    <p style="color: red; font-size: 16px;">Nous n'acceptons des commandes qu'entre 10 heures et 22
                        heures!</p>

                </div>

                <div class="row justify-content-center  mb-5 gy-3">
                    {{-- On récupère les id des menus qui ont été ajouté à la wishlist --}}
                    @php
                        $wishmenus = Cart::instance('wishlist')
                            ->content()
                            ->pluck('id');
                    @endphp
                    @if (count($menus) > 0)
                        @foreach ($menus as $menu)
                            <div class="col-md-4 col-xl-3" wire:key="menu-{{ $menu->id }}">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center item menu_item_grid h-100">
                                    <div class="item-img magnific-gall"ery">
                                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" loading="lazy">
                                        <div class="content">
                                            <a href="{{ asset($menu->image) }}" title="{{ $menu->name }}"
                                                data-effect="mfp-zoom-in"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <a href="{{ route('details', ['slug' => $menu->slug]) }}">
                                        <h3 class="p-2">{{ $menu->name }}</h3>
                                    </a>

                                    @if ($menu->available === 0)
                                        <span class="text-danger">indisponible</span>
                                    @endif
                                    <div class="d-flex flex-column price_box mt-auto">
                                        <p>{{ $menu->category->designation }}</p>
                                        <span class="mb-3">
                                            {{ $menu->price }} &euro;
                                        </span>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button title="Ajouter ce menu au panier" type="button"
                                                class="btn btn-success {{ $menu->available === 0 ? 'disabled' : '' }}"
                                                wire:click.prevent="storeMenu({{ $menu->id }},'{{ $menu->name }}',{{ $menu->price }})">
                                                <span style="color: white;">
                                                    <i class="fas fa-shopping-cart mx-2"></i>Ajouter
                                                </span>
                                            </button>
                                            {{-- Si l'id du menu est dans la wishmenus, cela veut dire qu'il y a été ajouté. On colore le bouton en rouge avec la classe bootstrap danger --}}
                                            @if ($wishmenus->contains($menu->id))
                                                <button title="Enlèver ce menu à la liste de souhaits"
                                                    class="btn btn-danger mx-2" type="button"
                                                    wire:click.prevent="removeMenuToWishList({{ $menu->id }})">
                                                    <span>
                                                        <i class="far fa-heart mx-2"></i>Wishlist
                                                    </span>
                                                </button>
                                            @else
                                                {{-- sinon on affiche un bouton outline (vide) --}}
                                                <button title="Ajouter ce menu à la liste de souhaits"
                                                    class="btn btn-outline-danger mx-2" type="button"
                                                    wire:click.prevent="addMenuToWishList({{ $menu->id }},'{{ $menu->name }}',{{ $menu->price }})">
                                                    <span>
                                                        <i class="far fa-heart mx-2"></i>Wishlist
                                                    </span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <p class="text-center my-5"><a href="#0" class="btn btn-outline-success">Download Menu (PDF)</a>
                </p>
                @if ($menus->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $menus->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
