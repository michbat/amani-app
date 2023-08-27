@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Commande confirmée</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<div>
    <main>
        <div class="pattern_2">
            <div class="container margin_60_40">
                <div class="row g-5">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-success">
                                <h4 class="text-center p-3" style="color: #fff">Résumé de votre commande</h4>
                            </div>
                            <div class="card body p-4" style="font-size: 23px;">
                                <ul class="list" style="list-style-type: none;">
                                    <li>
                                        <span>Numéro de commande</span> : {{ $order->id }}
                                    </li>
                                    <li>
                                        <span>Date de la commande</span> :
                                        {{ $order->created_at->translatedFormat('d M Y') }}
                                    </li>
                                    <li>
                                        <span>Sous-total</span> :
                                        {{ $order->subtotal }} &euro;
                                    </li>
                                    <li>
                                        <span>Montant de TVA</span> :
                                        {{ $order->tva }} &euro;
                                    </li>
                                    <li>
                                        <span>Montant total payé</span> :
                                        {{ $order->total }} &euro;
                                    </li>
                                    <li>
                                        <span>Méthode de paiement</span> :
                                        {{ $order->paymentMethod->label() }}
                                    </li>
                                    <li>
                                        <span>État de la commande</span>:
                                        {{ $order->orderStatus->label() }}
                                    </li>
                                </ul>
                                <div class="my-4">
                                    <hr>
                                </div>
                                <div class="row">
                                    <h4 class="text-center mb-4">Produits commandés</h4>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nom produit</th>
                                                <th class="text-center">Prix unitaire</th>
                                                <th class="text-center">Quantité</th>
                                                <th>Prix payé</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->menuOrders as $item)
                                                <tr>
                                                    <td>{{ $item->menu->name }}</td>
                                                    <td class="text-center">{{ $item->menu->price }}&euro;</td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td>{{ $item->sellPrice }}&euro;</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
