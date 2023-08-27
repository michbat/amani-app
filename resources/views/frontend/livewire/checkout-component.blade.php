@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Paiement</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<main>
    <div class="pattern_2">
        <div class="container margin_60_40">
            @if ($message = Session::get('stripe_error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="box_booking_2 style_2">
                        <div class="head">
                            <div class="title">
                                <h3>Vos informations personnelles</h3>
                            </div>
                        </div>
                        <div class="main">
                            <div class="form-group">
                                <label>Nom & Prénom</label>
                                <input class="form-control" placeholder="Nom et prénom"
                                    value="{{ $client->firstname }} {{ $client->lastname }}"
                                    @disabled(true)>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Adresse e-mail</label>
                                        <input class="form-control" placeholder="Email Address"
                                            value={{ $client->email }} @disabled(true)>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input class="form-control" placeholder="Phone" value="{{ $client->phone }}"
                                            @disabled(true)>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_booking_2 style_2">
                        <div class="head">
                            <div class="title">
                                <h3>Méthode de paiement</h3>
                            </div>
                        </div>
                        <div class="main">
                            <div class="payment_select">
                                <label class="container_radio">Carte de crédit
                                    <input type="radio" value="card" wire:model="paymentMethod">
                                    <span class="checkmark"></span>
                                </label>
                                <i class="icon_creditcard"></i>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Nom et prénom sur la carte <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="nameOnCard"
                                    placeholder="Nom et prénom" @disabled($paymentMethod === 'cash' || $paymentMethod === 'paypal')>
                                @error('nameOnCard')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Numéro de carte<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="number"
                                    placeholder="Numéro de carte de crédit" @disabled($paymentMethod === 'cash' || $paymentMethod === 'paypal')>
                                @error('number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Date d'expiration<span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="exp_month"
                                                    placeholder="mm" @disabled($paymentMethod === 'cash' || $paymentMethod === 'paypal')>
                                                @error('exp_month')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" wire:model="exp_year"
                                                    placeholder="aaaa" @disabled($paymentMethod === 'cash' || $paymentMethod === 'paypal')>
                                                @error('exp_year')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Cryptogramme visuel<span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-md-4 col-6">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" wire:model="cvc"
                                                        placeholder="CCV" @disabled($paymentMethod === 'cash' || $paymentMethod === 'paypal')>
                                                    @error('cvc')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <img src="{{ asset('frontend/assets/img/icon_ccv.gif') }}"
                                                    width="50" height="29" alt="ccv"><small>3
                                                    derniers digits</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment_select" id="paypal">
                                <label class="container_radio">Payer avec Paypal
                                    <input type="radio" value="paypal" wire:model="paymentMethod">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="payment_select">
                                <label class="container_radio">Payer en Cash
                                    <input type="radio" value="cash" wire:model="paymentMethod">
                                    <span class="checkmark"></span>
                                </label>
                                <i class="icon_wallet"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
                            <button type="submit" class="btn btn-success btn-lg"
                                wire:click.prevent="placeOrder">Commander</button>
                        </div>

                        paymentMethod = {{ var_export($paymentMethod) }}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
                    <div class="box_booking">
                        <div class="head">
                            <h3>Résumé de la commande</h3>
                        </div>
                        <div class="main">
                            <ul class="clearfix">
                                @foreach (Cart::content() as $content)
                                    <li>
                                        {{ $content->qty }}x {{ $content->model->name }}</>
                                        <span>{{ $content->model->price }}&euro;</span>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="clearfix">
                                <li>Sous-total<span>{{ Cart::subtotal() }}&euro;</span></li>
                                <li>TVA<span>{{ Cart::tax() }}&euro;</span></li>
                                <li class="total">Total<span>{{ Cart::total() }}&euro;</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
