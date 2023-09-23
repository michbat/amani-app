@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Boisson Détails</h1>
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
                        <a href="{{ asset($drink->image) }}" title="{{ $drink->name }}" data-effect="mfp-zoom-in"><img
                                src="{{ asset($drink->image) }}" alt="{{ $drink->name }}" class="img-fluid"></a>
                    </p>
                </div>
                <div class="col-lg-6" id="sidebar_fixed">
                    <div class="prod_info">
                        <h2>{{ $drink->name }} <span class="text-danger"
                                style="font-size: 20px">{{ $drink->available === 0 ? 'indisponible' : '' }}</span>
                        </h2>
                        <p>{!! $drink->description !!}</p>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main"><span class="new_price">{{ $drink->price }} &euro;</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                                <div class="btn_add_to_cart">
                                    @if (!auth()->user() || auth()->user()->firstname !== 'Generic')
                                        <a href="#"
                                            class="btn btn-success {{ $drink->available === 0 || $quantity >= 10 || $drink->canBeCommended === 0 || $global->opened === 0 ? 'disabled' : '' }}"
                                            style="min-width: 190px"
                                            wire:click.prevent="storeDrink({{ $drink->id }},'{{ $drink->name }}',{{ $drink->price }})"
                                            wire:model="$quantity"><i class="fas fa-shopping-cart mx-2"></i>Ajouter

                                            <span class="badge badge-info">{{ $quantity }}</span>

                                        </a>
                                    @else
                                        <a href="#" class="btn btn-success" style="min-width: 190px"
                                            wire:click.prevent="storeDrink({{ $drink->id }},'{{ $drink->name }}',{{ $drink->price }})"
                                            wire:model="$quantity"><i class="fas fa-shopping-cart mx-2"></i>Ajouter

                                            <span class="badge badge-info">{{ $quantity }}</span>

                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                @if (!auth()->user() || auth()->user()->firstname !== 'Generic')
                                    @if ($quantity >= 10)
                                        <span class="text-danger text-center">Vous ne pouvez pas commander au delà de 10
                                            articles d'une même boisson sur une seule commande</span>
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
                                    <div class="col-md-12">
                                        <h3>{{ $drink->category->designation }}</h3>
                                        <p>{!! $drink->category->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /tab-content -->
            </div>
        </div>
    </main>
</div>
