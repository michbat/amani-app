@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Panier</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<div>
    <main>
        <div class="bg_gray">
            <div class="container margin_60_40">
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>
                                MENU
                            </th>
                            <th>
                                PRIX
                            </th>
                            <th>
                                QUANTITÉ
                            </th>
                            <th>
                                TOTAL
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($message = Session::get('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Cart::count() > 0)
                            @foreach (Cart::content() as $element)
                                <tr>
                                    <td>
                                        <div class="thumb_cart">
                                            <img src="{{ asset($element->model->image) }}"
                                                data-src="{{ asset($element->model->image) }}" class="lazy"
                                                alt="{{ $element->model->name }}">
                                        </div>

                                        <span class="item_cart">
                                            <a href="{{ route('details', $element->model->id) }}" class="text-dark">
                                                {{ $element->qty }}x {{ $element->model->name }}
                                            </a>
                                            @if ($element->qty == 15)
                                                <span class="text-danger" style="font-size: 10px">(Veuillez nous
                                                    contacter si vous voulez
                                                    commander plus de 15 repas de ce menu!!)</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $element->model->price }}&euro;</strong>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button class="btn btn-success btn-sm mx-2"
                                                wire:click.prevent="decreaseQuantity('{{ $element->rowId }}')">-</button>
                                            <span class="border border-1 p-1 text-center"
                                                style="min-width: 100px;">{{ $element->qty }}</span>
                                            <button
                                                class="btn btn-success btn-sm mx-2 {{ $element->qty >= 15 ? 'disabled' : '' }}"
                                                wire:click.prevent="increaseQuantity('{{ $element->rowId }}')">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $element->subtotal }}&euro;</strong>
                                    </td>
                                    <td class="options">
                                        <a href="#" wire:click.prevent="destroy('{{ $element->rowId }}')"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p class="display-6 text-center">Panier vide <i class="far fa-frown fa-1x"></i></p>
                        @endif

                    </tbody>
                </table>
                <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                    <div class="col-sm-4 text-end">
                        <button type="button"
                            class="btn btn-outline-success {{ Cart::count() == 0 ? 'disabled' : '' }}"
                            wire:click="clearCart()">Vider votre
                            panier</button>
                    </div>
                    <div class="col-sm-8 text-start">
                        <a href="{{ route('menu') }}" class="btn btn-warning"><i
                                class="fas fa-caret-left mx-2 fa-1x"></i>Retournez au menu</a>
                    </div>
                </div>
                <!-- /cart_actions -->
            </div>
            <!-- /container -->
        </div>

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>Sous-total</span> {{ Cart::subtotal() }} &euro;
                            </li>
                            <li>
                                <span>TVA</span> {{ Cart::tax() }} &euro;
                            </li>
                            <li>
                                <span>Total</span> {{ Cart::total() }} &euro;
                            </li>
                        </ul>
                        {{-- Pour accéder à la page checkout, il faut être connecté. Si la personne est un guest, il est automatiquement dirigé vers
                            la page login pour s'authentifier. Si le panier est vide, le bouton est désactivé --}}

                        <a href="#" wire:click.prevent="checkout"
                            class="btn btn-success btn-lg cart {{ Cart::count() == 0 ? 'disabled' : '' }}">Procéder au
                            paiement</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
