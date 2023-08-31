@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Menu Details</h1>
        <p>Cuisine délicieuse au prix démocratique</p>
    </div>
@endsection
<div>
    <main>
        <div class="container margin_60_40">
            <div class="row">
                <div class="col-lg-6 magnific-gallery">
                    <p class="shop_setails_img">
                        <a href="{{ asset($menu->image) }}" title="{{ $menu->name }}" data-effect="mfp-zoom-in"><img
                                src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="img-fluid"></a>
                    </p>
                </div>
                <div class="col-lg-6" id="sidebar_fixed">
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
                        {{-- <div class="prod_options">
                            <div class="row"> --}}
                        {{-- <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantité</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="#"
                                            class="btn btn-success btn-sm mx-2 {{ $quantity == 1 || $menu->available == 0 ? 'disabled' : '' }}"
                                            wire:click.prevent="decreaseQuantity()">-</a>
                                        <span class="border border-1 p-1 text-center"
                                            style="min-width: 100px;">{{ $quantity }}</span>
                                        <a href="#"
                                            class="btn btn-success btn-sm mx-2 {{ $quantity == 15 || $menu->available == 0 ? 'disabled' : '' }}"
                                            wire:click.prevent="increaseQuantity()">+</a>
                                    </div> --}}
                        {{-- </div>
                                <div>
                                    @if ($quantity == 15)
                                        <span class="text-danger" style="font-size: 15px">Veuillez nous
                                            contacter si vous voulez
                                            commander plus de 15 repas de ce menu!!</span>
                                    @endif
                                </div> --}}
                        {{-- </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main"><span class="new_price">{{ $menu->price }} &euro;</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="btn_add_to_cart"><a href="#"
                                        class="btn btn-success {{ $menu->available === 0 || $quantity >= 15 ? 'disabled' : '' }}"
                                        style="min-width: 190px"
                                        wire:click.prevent="storeMenu({{ $menu->id }},'{{ $menu->name }}',{{ $menu->price }})"
                                        wire:model="$quantity"><i class="fas fa-shopping-cart mx-2"></i>Ajouter

                                        <span class="badge badge-light">{{ $quantity }}</span>

                                    </a>
                                </div>
                            </div>
                            <div class="mt-3">
                                @if ($quantity >= 15)
                                    <span class="text-danger text-center">Veuillez nous contacter si vous voulez commander plus de 15 produits</span>
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
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    Reviews
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon_star"></i><i
                                                        class="icon_star"></i><i class="icon_star"></i><i
                                                        class="icon_star"></i><i
                                                        class="icon_star"></i><em>5.0/5.0</em></span>
                                                <em>Published 54 minutes ago</em>
                                            </div>
                                            <h4>"Commpletely satisfied"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola
                                                sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat
                                                legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut.
                                                Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon_star"></i><i
                                                        class="icon_star"></i><i class="icon_star"></i><i
                                                        class="icon_star empty"></i><i
                                                        class="icon_star empty"></i><em>4.0/5.0</em></span>
                                                <em>Published 1 day ago</em>
                                            </div>
                                            <h4>"Always the best"</h4>
                                            <p>Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere
                                                fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer
                                                petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon_star"></i><i
                                                        class="icon_star"></i><i class="icon_star"></i><i
                                                        class="icon_star"></i><i
                                                        class="icon_star empty"></i><em>4.5/5.0</em></span>
                                                <em>Published 3 days ago</em>
                                            </div>
                                            <h4>"Outstanding"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola
                                                sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat
                                                legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut.
                                                Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon_star"></i><i
                                                        class="icon_star"></i><i class="icon_star"></i><i
                                                        class="icon_star"></i><i
                                                        class="icon_star"></i><em>5.0/5.0</em></span>
                                                <em>Published 4 days ago</em>
                                            </div>
                                            <h4>"Excellent"</h4>
                                            <p>Sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea,
                                                ius essent fuisset ut. Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <p class="text-end"><a href="leave-review.html" class="btn_1">Leave a review</a></p>
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
