@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Wishlist</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<div>
    <main>
        <!-- /filters -->
        <div class="pattern_2">
            <div class="container margin_60_40">
                @if ($message = Session::get('success_message'))
                    <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="main_title center">
                    <span style="background-color: green!important"><em
                            style="background-color: green!important"></em></span>

                    <h2 class="mb-3">Votre liste de souhaits</h2>

                </div>

                <div class="row justify-content-center  mb-5 gy-3">
                    {{-- On récupère les id des menus qui ont été ajouté à la wishlist --}}
                    @php
                        $wishitems = Cart::instance('wishlist')
                            ->content()
                            ->pluck('id');
                    @endphp
                    @if (Cart::instance('wishlist')->count() > 0)
                        @foreach (Cart::instance('wishlist')->content() as $item)
                            <div class="col-md-4 col-xl-3">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center item menu_item_grid h-100">
                                    <div class="item-img magnific-gallery">
                                        <img src="{{ asset($item->model->image) }}" alt="{{ $item->model->name }}"
                                            loading="lazy">
                                        <div class="content">
                                            <a href="{{ asset($item->model->image) }}" title="{{ $item->model->name }}"
                                                data-effect="mfp-zoom-in"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <a href="{{ route('details', ['slug' => $item->model->slug]) }}">
                                        <h3 class="p-2">{{ $item->model->name }}</h3>
                                    </a>

                                    @if ($item->model->available === 0)
                                        <span class="text-danger">indisponible</span>
                                    @endif
                                    <div class="d-flex flex-column price_box mt-auto">
                                        <p>{{ $item->model->category->designation }}</p>
                                        <span class="mb-3">
                                            {{ $item->model->price }} &euro;
                                        </span>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button title="Ajouter ce menu au panier" type="button"
                                                class="btn btn-success {{ $item->model->available === 0 ? 'disabled' : '' }}"
                                                wire:click.prevent="storeItem({{ $item->model->id }},'{{ $item->model->name }}',{{ $item->model->price }})">
                                                <span style="color: white;">
                                                    <i class="fas fa-shopping-cart mx-2"></i>Ajouter
                                                </span>
                                            </button>
                                            {{-- Si l'id du menu est dans la wishmenus, cela veut dire qu'il y a été ajouté. On colore le bouton en rouge avec la classe bootstrap danger --}}
                                            @if ($wishitems->contains($item->model->id))
                                                <button title="Enlèver ce menu à la liste de souhaits"
                                                    class="btn btn-danger mx-2" type="button"
                                                    wire:click.prevent="removeItemToWishList({{ $item->model->id }})">
                                                    <span>
                                                        <i class="far fa-heart mx-2"></i>Wishlist
                                                    </span>
                                                </button>
                                            @else
                                                {{-- sinon on affiche un bouton outline (vide) --}}
                                                <button title="Ajouter ce menu à la liste de souhaits"
                                                    class="btn btn-outline-danger mx-2" type="button"
                                                    wire:click.prevent="addItemToWishList({{ $item->model->id }},'{{ $item->model->name }}',{{ $item->model->price }})">
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
                    @else
                    <div class="col-md-12 col-xl-12 mt-5">
                        <h3 class="text-center"> Aucun produit dans votre wishlist</h3>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
