@extends('user.layouts.app')
@section('title', 'Index Commandes')
@section('content')

    <div class="mx-auto" style="width: 1600px">
        <div class="d-flex justify-content-end align-items-center my-4">
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary"><i class="fas fa-caret-left mx-2"></i>Retour en
                arrière</a>
        </div>

        <div class="card">
            <div class="card-header d-flex flex-column justify-content-center align-items-center">
                <h4 class="display-6">Vos commandes</h4>
                <p class="text-success">(Appuyey sur le bouton détails pour voir le détail de votre commande)</p>
                <p>{{ $orders->firstItem() }} à {{ $orders->lastItem() }} sur {{ $orders->total() }} commande(s)</p>
            </div>
            <div class="card-body">
                {{-- <div class="table-responsive"> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">N°</th>
                            <th scope="col">Date & Heure</th>
                            <th scope="col">Sous-Total</th>
                            <th scope="col">TVA</th>
                            <th scope="col">Total</th>
                            <th scope="col">Moyen de paiement</th>
                            <th scope="col">Status du paiement</th>
                            <th scope="col">Status de la commande</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($orders) > 0)
                            @foreach ($orders as $order)
                                <tr class="text-center">
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td>
                                        <span style="font-weight: 900">
                                            {{ $order->created_at->format('d/m/Y H:i') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 900">{{ $order->subtotal }}&euro;</span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 900">{{ $order->tva }}&euro;</span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 900">{{ $order->total }}&euro;</span>
                                    </td>
                                    <td>
                                        <span class="{{ $order->paymentMode->color() }}" style="border-radius: 50px">
                                            {{ $order->paymentMode->label() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $order->paymentStatus->color() }}" style="border-radius: 50px ;">
                                            {{ $order->paymentStatus->label() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $order->orderStatus->color() }}" style="border-radius: 50px">
                                            {{ $order->orderStatus->label() }}
                                        </span>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-warning mx-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#order_{{ $order->id }}"><i
                                                    class="fas fa-eye mx-2"></i>Détails</button>
                                            <a class="btn btn-success mx-2"
                                                href="{{ route('user.invoice.download', $order->id) }}">
                                                <i class="fas fa-file-alt mx-2"></i>Facture
                                            </a>
                                            <a class="btn btn-danger mx-2"
                                                href="{{ route('user.cancel.order', $order->id) }}"><i
                                                    class="far fa-window-close mx-2"></i>Annuler</a>

                                        </div>
                                    </td>
                                </tr>
                                <tr class="collapse" id="order_{{ $order->id }}">
                                    <td colspan="10">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>N°</th>
                                                    <th>Image</th>
                                                    <th>Menu</th>
                                                    <th>Prix unitaire</th>
                                                    <th>Quantité</th>
                                                    <th>Sous-total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->menuOrders as $item)
                                                    <tr class="text-center">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td><img src="{{ asset($item->menu->image) }}"
                                                                alt="{{ $item->menu->name }}" style="width: 60px;">
                                                        </td>
                                                        <td>{{ $item->menu->name }}</td>
                                                        <td>{{ $item->menu->price }}&euro;</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->sellPrice }}&euro;</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">
                                    <h2>Pas de commandes</h2>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{-- </div> --}}
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $orders->links() }}
        </div>
    </div>



@endsection
