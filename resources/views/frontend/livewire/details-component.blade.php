@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Menu Détails</h1>
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
            <div class="row">
                <p class="text-center text-danger">Nous n'acceptons des commandes qu'entre 10 heures et 23 heures!</p>
                <div class="col-lg-6 magnific-gallery">
                    <p class="shop_setails_img">
                        <a href="{{ asset($menu->image) }}" title="{{ $menu->name }}" data-effect="mfp-zoom-in"><img
                                src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="img-fluid"></a>
                    </p>
                </div>
                <div class="col-lg-6" id="sidebar_fixed">
                    {{-- On récupère les id des menus qui ont été ajouté à la wishlist --}}
                    @php
                        $wishmenus = Cart::instance('wishlist')
                            ->content()
                            ->pluck('id');
                    @endphp
                    <div class="prod_info">
                        <h2>{{ $menu->name }} <span class="text-danger"
                                style="font-size: 20px">{{ $menu->available === 0 ? 'indisponible' : '' }}</span>
                        </h2>
                        @if (count($menu->tags) > 0)
                            <span>Tags:</span>
                            @foreach ($menu->tags as $tag)
                                <span class="btn btn-info btn-sm mx-1"
                                    style="border-radius: 50px">{{ $tag->name }}</span>
                            @endforeach
                        @endif
                        <span class=" d-block rating mt-4">

                            <em>4 Avis</em>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star voted"></i>
                            <i class="icon_star"></i>
                        </span>
                        <p>{!! $menu->description !!}</p>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main"><span class="new_price">{{ $menu->price }} &euro;</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                                <div class="btn_add_to_cart">
                                    <a href="#"
                                        class="btn btn-success {{ $menu->available === 0 || $quantity > 10 || $menu->canBeCommended === 0 ? 'disabled' : '' }}"
                                        style="min-width: 190px"
                                        wire:click.prevent="storeMenu({{ $menu->id }},'{{ $menu->name }}',{{ $menu->price }})"
                                        wire:model="$quantity"><i class="fas fa-shopping-cart mx-2"></i>Ajouter

                                        <span class="badge badge-light">{{ $quantity }}</span>

                                    </a>
                                </div>
                                <div class="btn_add_to_cart">
                                    {{-- Si l'id du menu est dans la wishmenus, cela veut dire qu'il y a été ajouté. On colore le bouton en rouge avec la classe bootstrap danger --}}
                                    @if ($wishmenus->contains($menu->id))
                                        <button title="Enlèver ce menu à la liste de souhaits"
                                            class="btn btn-danger mx-2" style="min-width: 200px;"
                                            wire:click.prevent="removeMenuToWishList({{ $menu->id }})">
                                            <span>
                                                <i class="far fa-heart mx-2"></i>Wishlist
                                            </span>
                                        </button>
                                    @else
                                        {{-- sinon on affiche un bouton outline (vide) --}}
                                        <button title="Ajouter ce menu à la liste de souhaits"
                                            class="btn btn-outline-danger mx-2" style="min-width: 200px;"
                                            wire:click.prevent="addMenuToWishList({{ $menu->id }},'{{ $menu->name }}',{{ $menu->price }})">
                                            <span>
                                                <i class="far fa-heart mx-2"></i>Wishlist
                                            </span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                @if ($quantity > 10)
                                    <span class="text-danger text-center">Veuillez nous contacter si vous voulez
                                        commander plus de 10 menus</span>
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
                                        <h3>{{ $menu->category->designation }}</h3>
                                        <p>{!! $menu->category->description !!}</p>
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
                                                    @foreach ($menu->ingredients as $ingredient)
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
                                                        <span class="rating"><i class="icon_star"></i><i
                                                                class="icon_star"></i><i class="icon_star"></i><i
                                                                class="icon_star"></i><i
                                                                class="icon_star empty"></i><em>4.5/5.0</em></span>
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
                                        <a href="{{ route('review', ['slug' => $menu->slug, 'user' => Auth::user()->id]) }}"
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
