@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Boissons</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection

<div>
    <main>
        <div class="filters_full clearfix">
            <div class="container d-flex justify-content-between">
                <div class="count_results">
                    @if ($drinks->count() > 0)
                        <p>{{ $drinks->firstItem() }} à {{ $drinks->lastItem() }} sur {{ $drinks->total() }} boisson(s)
                        </p>
                    @endif
                </div>
                <div>
                    <select name="page" class="form-control" style="min-width: 150px" wire:model="pageItems">
                        <option value="4">4 boissons</option>
                        <option value="8">8 boissons</option>
                        <option value="12">12 boissons</option>
                        <option value="16">16 boissons</option>
                        <option value="20">20 boissons</option>
                    </select>
                </div>
                <div class="sort_select">
                    <select wire:model="orderBy">
                        <option value="default">Par défaut</option>
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
                    <div class="col-md-5">
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
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-5">
                        <div class="filter_type">
                            <h6>Prix</h6>
                            @php
                                $range1 = 0;
                                $range2 = 0;
                                $range3 = 0;
                                $range4 = 0;
                                foreach ($categories as $category) {
                                    foreach ($category->drinks as $drink) {
                                        if ($drink->price > 0 && $drink->price <= 5) {
                                            $range1 += 1;
                                        }
                                        if ($drink->price > 5 && $drink->price <= 10) {
                                            $range2 += 1;
                                        }
                                        if ($drink->price > 10 && $drink->price <= 15) {
                                            $range3 += 1;
                                        }
                                        if ($drink->price > 15 && $drink->price <= 20) {
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
                        <h2 class="mb-3">Boissons</h2>
                    @else
                        @foreach ($cats as $cat)
                            <h2 class="mb-3" style="display: inline-block">{{ $cat }},</h2>
                        @endforeach
                    @endempty
                    @if ($global->opened == 0)
                        <p style="color: red; font-size: 20px;">Restaurant fermé! PAS DE COMMANDES!!!</p>
                    @else
                        <p style="color: red; font-size: 20px;">Nous n'acceptons des commandes qu'entre 10 heures et 23
                            heures!</p>
                    @endif

                </div>

                <div class="row justify-content-center  mb-5 gy-3">
                    @if (count($drinks) > 0)
                        @foreach ($drinks as $drink)
                            <div class="col-md-4 col-xl-3" wire:key="menu-{{ $drink->id }}">
                                <div
                                    class="d-flex flex-column justify-content-center align-items-center item menu_item_grid h-100">
                                    <div class="item-img magnific-gallery">
                                        <img src="{{ asset($drink->image) }}" alt="{{ $drink->name }}"
                                            loading="lazy">
                                        <div class="content">
                                            <a href="{{ asset($drink->image) }}" title="{{ $drink->name }}"><i
                                                    class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <a href="{{ route('details.drink', ['slug' => $drink->slug]) }}">
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
                                                class="btn btn-success {{ $drink->available === 0 || $drink->canBeCommended === 0 || $global->opened === 0 ? 'disabled' : '' }}"
                                                wire:click.prevent="storeDrink({{ $drink->id }},'{{ $drink->name }}',{{ $drink->price }})">
                                                <span style="color: white;">
                                                    <i class="fas fa-shopping-cart mx-2"></i>Ajouter
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
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
