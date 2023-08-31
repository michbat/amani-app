<li>
    <div class="dropdown dropdown-cart">
        <a href="{{ route('cart') }}" class="cart_bt"><i class="fas fa-cart-plus"></i>
            <strong>{{ Cart::instance('cart')->count() ?? 0 }}</strong></a>
        <div class="dropdown-menu">
            @if (Cart::instance('cart')->count() > 0)
                <ul>
                    @foreach (Cart::instance('cart')->content() as $content)
                        <li>
                            <figure>
                                <img src="{{ asset($content->model->image) }}"
                                    data-src="{{ asset($content->model->image) }}" alt="{{ $content->model->name }}"
                                    width="50" height="50" class="lazy">
                            </figure>
                            <strong><span>{{ $content->qty }}x
                                    {{ $content->model->name }}</span>{{ $content->model->price }}
                                &euro;</strong>
                            <a href="#" class="action" wire:click.prevent="destroy('{{ $content->rowId }}')"><i
                                    class="icon_trash_alt"></i></a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="total_drop">
                <div class="clearfix add_bottom_15">
                    <strong>Sous-total</strong><span>{{ Cart::instance('cart')->subtotal() }}&euro;</span><br>
                    <strong>TVA</strong><span>{{ Cart::instance('cart')->tax() }}&euro;</span><br>
                    <strong>Total</strong><span>{{ Cart::instance('cart')->total() }}&euro;</span>
                </div>
                <a href="{{ route('cart') }}" class="btn_1">Voir votre panier</a>

                {{-- Pour accéder à la page checkout, il faut être connecté. Si la personne est un guest, il est automatiquement dirigé vers
                la page login pour s'authentifier. Si le panier est vide, le bouton est désactivé --}}

                <a href="#" wire:click.prevent="checkout"
                    class="btn btn-success mt-2 {{ Cart::count() == 0 ? 'disabled' : '' }}"
                    style="min-width: 100%">Payer</a>
            </div>
        </div>
    </div>
</li>
