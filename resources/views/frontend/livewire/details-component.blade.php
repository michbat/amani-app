@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Plat en détails</h1>
        <p>Cuisine délicieuse au prix démocratique</p>
    </div>
@endsection

<div>
    <main>
        <div class="container margin_60_40" style="position: relative">
            @if ($message = Session::get('success_message'))
                <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('warning_message'))
                <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                @if ($global->opened == 0)
                    <p class="text-center text-danger" style="font-size: 20px;">Restaurant fermé! PAS DE COMMANDES!!!
                    </p>
                @else
                    <p class="text-center text-danger" style="font-size: 20px;">Nous n'acceptons des commandes qu'entre
                        10 heures et 23 heures!
                    </p>
                @endif
                <div class="col-lg-6 magnific-gallery">
                    <p class="shop_setails_img">
                        <a href="{{ asset($plat->image) }}" title="{{ $plat->name }}" data-effect="mfp-zoom-in"><img
                                src="{{ asset($plat->image) }}" alt="{{ $plat->name }}" class="img-fluid"></a>
                    </p>
                </div>
                <div class="col-lg-6" id="sidebar_fixed">
                    {{-- On récupère les id des plats qui ont été ajouté à la wishlist --}}
                    @php
                        $wishplats = Cart::instance('wishlist')
                            ->content()
                            ->pluck('id');
                    @endphp
                    <div class="prod_info">
                        <h2>{{ $plat->name }} <span class="text-danger"
                                style="font-size: 20px">{{ $plat->available === 0 ? 'indisponible' : '' }}</span>
                        </h2>
                        @if (count($plat->tags) > 0)
                            <span>Tags:</span>
                            @foreach ($plat->tags as $tag)
                                <span class="btn btn-info btn-sm mx-1"
                                    style="border-radius: 50px">{{ $tag->name }}</span>
                            @endforeach
                        @endif
                        <span class=" d-block rating mt-4">
                            @php
                                $cpt = 0;
                                foreach ($plat->reviews as $review) {
                                    if ($review->published) {
                                        $cpt += 1;
                                    }
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
                        <p>{!! $plat->description !!}</p>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main"><span class="new_price">{{ $plat->price }} &euro;</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                                <div class="btn_add_to_cart">
                                    @if (!auth()->user() || auth()->user()->firstname !== 'Generic')
                                        <a href="#"
                                            class="btn btn-success {{ $plat->available === 0 || $quantity >= 6 || $plat->canBeCommended === 0 || $global->opened === 0 ? 'disabled' : '' }}"
                                            style="min-width: 190px"
                                            wire:click.prevent="storePlat({{ $plat->id }},'{{ $plat->name }}',{{ $plat->price }})"
                                            wire:model="$quantity"><i class="fas fa-shopping-cart mx-2"></i>Ajouter

                                            <span class="badge badge-info">{{ $quantity }}</span>

                                        </a>
                                    @else
                                        <a href="#" class="btn btn-success" style="min-width: 190px"
                                            wire:click.prevent="storePlat({{ $plat->id }},'{{ $plat->name }}',{{ $plat->price }})"
                                            wire:model="$quantity"><i class="fas fa-shopping-cart mx-2"></i>Ajouter

                                            <span class="badge badge-info">{{ $quantity }}</span>

                                        </a>
                                    @endif
                                </div>
                                <div class="btn_add_to_cart">
                                    {{-- Si l'id du plat est dans la wishplats, cela veut dire qu'il y a été ajouté. On colore le bouton en rouge avec la classe bootstrap danger --}}
                                    @if (!auth()->user() || auth()->user()->firstname !== 'Generic')
                                        @if ($wishplats->contains($plat->id))
                                            <button title="Enlèver ce plat à la liste de souhaits"
                                                class="btn btn-danger mx-2" style="min-width: 200px;"
                                                wire:click.prevent="removePlatToWishList({{ $plat->id }})">
                                                <span>
                                                    <i class="far fa-heart mx-2"></i>Wishlist
                                                </span>
                                            </button>
                                        @else
                                            {{-- sinon on affiche un bouton outline (vide) --}}
                                            <button title="Ajouter ce plat à la liste de souhaits"
                                                class="btn btn-outline-danger mx-2" style="min-width: 200px;"
                                                wire:click.prevent="addPlatToWishList({{ $plat->id }},'{{ $plat->name }}',{{ $plat->price }})">
                                                <span>
                                                    <i class="far fa-heart mx-2"></i>Wishlist
                                                </span>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                @if (!auth()->user() || auth()->user()->firstname !== 'Generic')
                                    @if ($quantity >= 6)
                                        <span class="text-danger text-center">Vous ne pouvez pas commander au delà de 6
                                            articles d'un même plat sur une seule commande</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /prod_info -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab"
                            role="tab">Catégorie</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Avis</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                    aria-controls="collapse-A">
                                    Catégorie
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>{{ $plat->category->designation }}</h3>
                                        <p>{!! $plat->category->description !!}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Ingredients</h3>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <tbody>
                                                    <thead>
                                                        <tr>
                                                            <th>Nom</th>
                                                            <th>Quantité</th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($plat->ingredients as $ingredient)
                                                        <tr>
                                                            <td><strong>{{ $ingredient->name }}</strong></td>
                                                            <td>
                                                                {{ $ingredient->pivot->amount }}
                                                                {{ $ingredient->unit->symbol }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B"
                                    aria-expanded="false" aria-controls="collapse-B">
                                    Reviews
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <!-- /row -->
                                <div class="row justify-content-between">
                                    @if (count($reviews) > 0)
                                        @foreach ($reviews as $review)
                                            <div class="col-lg-6">
                                                <div class="review_content">
                                                    <div class="clearfix add_bottom_10">
                                                        <span class="rating">
                                                            @for ($i = 0; $i < $review->rating; $i++)
                                                                <i class="icon_star"></i>
                                                            @endfor
                                                            @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                                <i class="icon_star" style="color:gray;"></i>
                                                            @endfor
                                                            <em>{{ $review->rating }}.0/5.0</em>
                                                        </span>
                                                        <em>Publié le
                                                            {{ $review->created_at->format('d/m/Y à H:i:s') }}</em>
                                                    </div>
                                                    <h4>{{ $review->title }}
                                                        <span
                                                            style="font-size: 12px; color: green; margin-left: 15px;">par
                                                            {{ $review->user->firstname }}
                                                            {{ $review->user->lastname }}</span>
                                                    </h4>
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- /row -->
                                <p class="text-end">
                                    @auth
                                        <a href="{{ route('review', ['slug' => $plat->slug, 'user' => Auth::user()->id]) }}"
                                            class="btn btn-success {{ auth()->user()->censoredComments >= 5 ? 'disabled' : '' }}"><i
                                                class="fas fa-comment mx-2"></i>Commentez</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-success">Connectez-vous pour
                                            commenter</a>
                                    @endauth
                                </p>
                            </div>
                            <!-- /card-body -->
                        </div>
                    </div>
                </div>
                <!-- /tab-content -->
            </div>
        </div>
    </main>
</div>
