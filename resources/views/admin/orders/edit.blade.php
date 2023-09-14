@extends('admin.layouts.app')
@section('title', 'Éditer une commande')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.orders.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Éditer une commande</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-5">
                    <div class="col-sm-6">
                        <label for="client" class="form-label">Client</label>
                        <input type="text" class="form-control"
                            value="{{ $order->user->firstname }} {{ $order->user->lastname }}" disabled>
                    </div>
                    <div class="col-sm-6">
                        <label for="date" class="form-label">Date de la commande</label>
                        <input type="text" class="form-control"
                            value="{{ $order->created_at->format('d/m/Y  à H:i:s') }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-5">
                    <div class="col-sm-4">
                        <label for="subtotal" class="form-label">Sous-Total(&euro;)</label>
                        <input type="number" name="subtotal" id="subtotal" value="{{ $order->subtotal }}"
                            class="form-control">
                        @error('subtotal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="tva" class="form-label">TVA(&euro;)</label>
                        <input type="number" name="tva" id="tva" value="{{ $order->tva }}"
                            class="form-control">
                        @error('tva')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="total" class="form-label">Total(&euro;)</label>
                        <input type="number" name="total" id="total" value="{{ $order->total }}"
                            class="form-control">
                        @error('total')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-5">
                    <div class="col-sm-4">
                        <label for="nameOnCard" class="form-label">Nom et prénom sur la carte</label>
                        <input type="text" name="nameOnCard" id="nameOnCard" class="form-control"
                            {{ $order->paymentMode->value != App\Enums\PaymentMode::CARD->value ? 'disabled' : '' }}
                            value="{{ $order->nameOnCard }}">
                        @error('nameOnCard')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="numberOnCard" class="form-label">Numéro de la carte</label>
                        <input type="text" name="numberOnCard" id="numberOnCard" class="form-control"
                            value="{{ $order->numberOnCard }}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="expirationDate" class="form-label">Date d'expiration</label>
                        <input type="text" name="expirationDate" id="expirationDate" class="form-control"
                            value="{{ $order->expirationDate }}" disabled>
                    </div>
                </div>

                <div class="form-group row mb-5">
                    <div class="col-sm-4">
                        <label for="pm" class="form-label">Moyen de paiement<button
                                class="btn btn-warning btn-sm mx-2 text-dark">{{ $order->paymentMode->label() }}</button></label>
                        <select name="paymentMode" id="pm" class="form-control selectric">
                            @foreach ($paymentmodes as $pm)
                                <option value="{{ $pm->value }}" @selected($pm->value == $order->paymentMode->value)>
                                    {{ $pm->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('paymentMode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="ps" class="form-label">Status de paiement <button
                                class="btn btn-success btn-sm mx-2 text-dark">{{ $order->paymentStatus->label() }}</button></label>
                        <select name="paymentStatus" id="ps" class="form-control selectric">
                            @foreach ($paymentstatus as $ps)
                                <option value="{{ $ps->value }}" @selected($ps->value == $order->paymentStatus->value)>
                                    {{ $ps->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('paymentStatus')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="os" class="form-label">Status de la commande <button
                                class="btn btn-info btn-sm mx-2 text-dark">{{ $order->orderStatus->label() }}</button></label>
                        <select name="orderStatus" id="os" class="form-control selectric">
                            @foreach ($orderstatus as $os)
                                <option value="{{ $os->value }}" @selected($os->value == $order->orderStatus->value)>
                                    {{ $os->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('paymentStatus')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


            </div>
            <div class="card-footer mb-3">
                <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i
                        class="far fa-edit mx-2"></i>Editer</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
@endsection
