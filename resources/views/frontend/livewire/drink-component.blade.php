@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Boissons</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
@push('styles')
    <style>
        .container.margin_60_40 {
            position: relative;
            /* Assurez-vous que le container a une position relative */
        }

        .fixed-alert {
            position: absolute;
            /* Position absolue à l'intérieur du container */
            top: 0;
            /* Position en haut du container */
            left: 0;
            /* Position à gauche du container */
            right: 0;
            /* Position à droite du container */
            z-index: 9999;
            /* Pour être au-dessus du contenu du container */
            width: 100%;
            /* Ajustez la largeur selon les besoins */
        }
    </style>
@endpush
<div>
    <main>
        <div class="filters_full clearfix">
            <div class="container d-flex justify-content-between">
                <div class="count_results">
                    @if ($drinks->count() > 0)
                        <p>{{ $drinks->firstItem() }} à {{ $drinks->lastItem() }} sur {{ $drinks->total() }} item(s)</p>
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
                                            <small>{{ $category->drinks->count() }}</small>
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
                        <h2 class="mb-3">Boissons</h2>
                    @else
                        @foreach ($cats as $cat)
                            <h2 class="mb-3" style="display: inline-block">{{ $cat }},</h2>
                        @endforeach
                    @endempty
                    <p style="color: red; font-size: 16px;">Les boissons peuvent être commandées jusqu'à la fermeture du restaurant c'est à dire de 10h à minuit</p>

                </div>

                <div class="row justify-content-center  mb-5 gy-3">
                    {{-- On récupère les id des drinks qui ont été ajouté à la wishlist --}}
                    @php
                        $wishdrinks = Cart::instance('wishlist')
                            ->content()
                            ->pluck('id');
                    @endphp
                    @if (count($drinks) > 0)
                        @foreach ($drinks as $drink)
                            <div class="col-md-4 col-xl-3" wire:key="menu-{{ $drink->id }}">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center item menu_item_grid h-100">
                                    <div class="item-img magnific-gallery">
                                        <img src="{{ asset($drink->image) }}" alt="{{ $drink->name }}" loading="lazy">
                                        <div class="content">
                                            <a href="{{ asset($drink->image) }}" title="{{ $drink->name }}"
                                                data-effect="mfp-zoom-in"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <a href="{{ route('details', ['slug' => $drink->slug]) }}">
                                        <h3 class="p-2">{{ $drink->name }}</h3>
                                    </a>

                                    @if ($drink->available === 0)
                                        <span class="text-danger">indisponible</span>
                                    @endif
                                    <div class="d-flex flex-column price_box mt-auto">
                                        <p>{{ $drink->category->designation }}</p>
                                        <span class="mb-3">
                                            {{ $drink->price }} &euro;
                                        </span>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button title="Ajouter ce menu au panier" type="button"
                                                class="btn btn-success {{ $drink->available === 0 || $drink->canBeCommended === 0 ? 'disabled' : '' }}"
                                                wire:click.prevent="storeDrink({{ $drink->id }},'{{ $drink->name }}',{{ $drink->price }})">
                                                <span style="color: white;">
                                                    <i class="fas fa-shopping-cart mx-2"></i>Ajouter
                                                </span>
                                            </button>
                                            {{-- Si l'id du menu est dans la wishdrinks, cela veut dire qu'il y a été ajouté. On colore le bouton en rouge avec la classe bootstrap danger --}}
                                            @if ($wishdrinks->contains($drink->id))
                                                <button title="Enlèver ce menu à la liste de souhaits"
                                                    class="btn btn-danger mx-2" type="button"
                                                    wire:click.prevent="removeDrinkToWishList({{ $drink->id }})">
                                                    <span>
                                                        <i class="far fa-heart mx-2"></i>Wishlist
                                                    </span>
                                                </button>
                                            @else
                                                {{-- sinon on affiche un bouton outline (vide) --}}
                                                <button title="Ajouter ce menu à la liste de souhaits"
                                                    class="btn btn-outline-danger mx-2" type="button"
                                                    wire:click.prevent="addDrinkToWishList({{ $drink->id }},'{{ $drink->name }}',{{ $drink->price }})">
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
                @if ($drinks->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $drinks->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

