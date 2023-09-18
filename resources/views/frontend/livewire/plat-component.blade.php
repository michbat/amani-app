@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Plats à la carte</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<div>
    <main>
        <div class="filters_full clearfix">
            <div class="container d-flex justify-content-between">
                <div class="count_results">
                    @if ($plats->count() > 0)
                        <p>{{ $plats->firstItem() }} à {{ $plats->lastItem() }} sur {{ $plats->total() }} plat(s)</p>
                    @endif
                </div>
                <div>
                    <select name="page" class="form-control" style="min-width: 150px" wire:model="pageItems">
                        <option value="4">4 plats</option>
                        <option value="8">8 plats</option>
                        <option value="12">12 plats</option>
                        <option value="16">16 plats</option>
                        <option value="20">20 plats</option>
                    </select>
                </div>
                <div class="sort_select">
                    <select wire:model="orderBy">
                        <option value="default">Par défaut</option>
                        <option value="rating">Mieux noté</option>
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
                                            <small>{{ $category->plats->count() }}</small>
                                            <input wire:model="cats" value="{{ $category->designation }}"
                                                type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        {{-- <div class="filter_type">
                            <h6>Avis</h6>
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
                        </div> --}}
                    </div>
                    <div class="col-md-4">
                        <div class="filter_type">
                            <h6>Prix</h6>
                            @php
                                $range1 = 0;
                                $range2 = 0;
                                $range3 = 0;
                                $range4 = 0;
                                foreach ($categories as $category) {
                                    foreach ($category->plats as $plat) {
                                        if ($plat->price > 0 && $plat->price <= 5) {
                                            $range1 += 1;
                                        }
                                        if ($plat->price > 5 && $plat->price <= 10) {
                                            $range2 += 1;
                                        }
                                        if ($plat->price > 10 && $plat->price <= 15) {
                                            $range3 += 1;
                                        }
                                        if ($plat->price > 15 && $plat->price <= 20) {
                                            $range4 += 1;
                                        }
                                    }
                                }
                            @endphp
                            <ul>
                                <li>
                                    <label class="container_check">0&euro; — 5&euro;<small>{{ $range1 }}</small>
                                        <input wire:model="priceIntervals" value="0-5" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">5&euro; — 10&euro;<small>{{ $range2 }}</small>
                                        <input wire:model="priceIntervals" value="5-10" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">10&euro; — 15&euro;<small>{{ $range3 }}</small>
                                        <input wire:model="priceIntervals" value="10-15" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_check">15&euro; — 20&euro;<small>{{ $range4 }}</small>
                                        <input wire:model="priceIntervals" value="15-20" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /filters -->
        <div class="pattern_2">
            <div class="container margin_60_40 flash-container">
                @if ($message = Session::get('success_message'))
                    <div class="fixed-alert alert alert-success alert-dismissible fade show my-4" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="main_title center">
                    <span style="background-color: green!important"><em
                            style="background-color: green!important"></em></span>

                    <!-- Si il n'y a aucun filtrage par catégorie, on affichage toutes les catégories  -->
                    @empty($cats)
                        <h2 class="mb-3">Entrées, Plats principaux & Desserts</h2>
                    @else
                        @foreach ($cats as $cat)
                            <h2 class="mb-3" style="display: inline-block">{{ $cat }},</h2>
                        @endforeach
                    @endempty
                    @if ($global && $global->opened == 0)
                        <p style="color: red; font-size: 20px;">Restaurant fermé! PAS DE COMMANDES!!!</p>
                    @else
                        <p style="color: red; font-size: 20px;">Nous n'acceptons des commandes qu'entre 10 heures et 23
                            heures!</p>
                    @endif

                </div>

                <div class="row justify-content-center  mb-5 gy-3">
                    {{-- On récupère les id des plats qui ont été ajouté à la wishlist --}}
                    @php
                        $wishplats = Cart::instance('wishlist')
                            ->content()
                            ->pluck('id');
                    @endphp
                    @if (count($plats) > 0)
                        @foreach ($plats as $plat)
                            <div class="col-md-4 col-xl-3" wire:key="plat-{{ $plat->id }}">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center item menu_item_grid h-100">
                                    <div class="item-img magnific-gallery">
                                        <img src="{{ asset($plat->image) }}" alt="{{ $plat->name }}" loading="lazy">
                                        <div class="content">
                                            <a href="{{ asset($plat->image) }}" title="{{ $plat->name }}"
                                                data-effect="mfp-zoom-in"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <a href="{{ route('details', ['slug' => $plat->slug]) }}">
                                        <h3 class="p-2">{{ $plat->name }}</h3>
                                    </a>

                                    {{-- Les étoiles du rating --}}

                                    @if ($plat->available === 0)
                                        <span class="text-danger">indisponible</span>
                                    @endif

                                    <div class="d-flex flex-column price_box mt-auto">
                                        <p>
                                            {{ $plat->category->designation }}
                                            <a href="{{ route('details', ['slug' => $plat->slug]) }}">
                                                <span class=" d-block rating mt-4">
                                                    @php
                                                        $cpt = 0;
                                                        $rating = 0;
                                                        foreach ($plat->reviews as $review) {
                                                            if ($review->published == 1) {
                                                                $cpt += 1;
                                                                $rating += $review->rating;
                                                            }
                                                        }
                                                        if ($cpt == 0) {
                                                            $avg = floor($rating);
                                                        } else {
                                                            $avg = floor($rating / $cpt);
                                                        }
                                                    @endphp
                                                    <em>{{ $cpt }} Avis</em>
                                                    @for ($i = 0; $i < $avg; $i++)
                                                        <i class="icon_star voted"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $avg; $i++)
                                                        <i class="icon_star"></i>
                                                    @endfor

                                                </span>
                                            </a>
                                        </p>
                                        <span class="mb-3">
                                            {{ $plat->price }} &euro;
                                        </span>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button title="Ajouter ce plat au panier" type="button"
                                                class="btn btn-success {{ $plat->available === 0 || $plat->canBeCommended === 0 || $global->opened === 0 ? 'disabled' : '' }}"
                                                wire:click.prevent="storePlat({{ $plat->id }},'{{ $plat->name }}',{{ $plat->price }})">
                                                <span style="color: white;">
                                                    <i class="fas fa-shopping-cart mx-2"></i>Ajouter
                                                </span>
                                            </button>
                                            {{-- Si l'id du plat est dans la wishplats, cela veut dire qu'il y a été ajouté. On colore le bouton en rouge avec la classe bootstrap danger --}}
                                            @if (!auth()->user() || auth()->user()->firstname !== 'Generic')
                                                @if ($wishplats->contains($plat->id))
                                                    <button title="Enlèver ce plat à la liste de souhaits"
                                                        class="btn btn-danger mx-2" type="button"
                                                        wire:click.prevent="removePlatToWishList({{ $plat->id }})">
                                                        <span>
                                                            <i class="far fa-heart mx-2"></i>Wishlist
                                                        </span>
                                                    </button>
                                                @else
                                                    {{-- sinon on affiche un bouton outline (vide) --}}
                                                    <button title="Ajouter ce plat à la liste de souhaits"
                                                        class="btn btn-outline-danger mx-2" type="button"
                                                        wire:click.prevent="addPlatToWishList({{ $plat->id }},'{{ $plat->name }}',{{ $plat->price }})">
                                                        <span>
                                                            <i class="far fa-heart mx-2"></i>Wishlist
                                                        </span>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                </p>
                @if ($plats->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $plats->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
