@extends('personnel.layouts.app')
@section('title', 'Orders Index')

@section('content')
    {{-- <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.orders.create') }}"><i
                class="fas fa-plus mx-2"></i>Ajouter une
            catégorie de recettes</a>
    </div> --}}
    <div class="card mt-5">
        <div class="card-header">
            <div class="card-header d-flex flex-column justify-content-center align-items-start">
                <h4>Liste des commandes</h4>
                <p>{{ $orders->firstItem() }} à {{ $orders->lastItem() }} sur {{ $orders->total() }} commande(s)</p>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>User</th>
                        <th>Date-Heure</th>
                        <th>Sous-total</th>
                        <th>TVA</th>
                        <th>Total</th>
                        <th>Moyen de paiement</th>
                        <th>Status du paiement</th>
                        <th>Status de la commande</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <span style="font-weight: 900">
                                        <a href="{{ route('personnel.users.show', $order->user_id) }}">
                                            @if ($order->user)
                                                {{ $order->user->firstname }}
                                                {{ $order->user->lastname }}
                                            @endif
                                        </a>
                                    </span>
                                </td>
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
                                    <span class="{{ $order->paymentStatus->color() }}" style="border-radius: 50px">
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

                                        {{-- <a href="{{ route('personnel.orders.show', $order->id) }}"
                                            class="btn btn-warning text-dark mx-2">
                                            <i class="fas fa-eye mx-2"></i>Détails
                                        </a> --}}
                                        <button class="btn btn-warning text-dark mx-2" type="button" data-toggle="collapse"
                                            data-target="#order_{{ $order->id }}"><i
                                                class="fas fa-eye mx-2"></i>Détails</button>

                                        <a class="btn btn-primary text-dark mx-2"
                                            href="{{ route('personnel.orders.edit', $order->id) }}"><i
                                                class="fas fa-edit mx-2"></i>Editer</a>

                                        <form action="{{ route('personnel.orders.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-dark confirm"><i
                                                    class="fas fa-trash mx-2"></i>Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse" id="order_{{ $order->id }}">
                                <td colspan="10">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Image</th>
                                                <th>Produit</th>
                                                <th>Prix unitaire</th>
                                                <th>Quantité</th>
                                                <th>Sous-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->lineOrders as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    {{-- Si $item est un plat --}}
                                                    @if ($item->plat)
                                                        <td><img src="{{ asset($item->plat->image) }}"
                                                                alt="{{ $item->plat->name }}" style="width: 60px;"></td>
                                                        <td>{{ $item->plat->name }}</td>
                                                        <td>{{ $item->plat->price }}&euro;</td>
                                                    @else
                                                        {{-- Si $item est un drink --}}
                                                        <td><img src="{{ asset($item->drink->image) }}"
                                                                alt="{{ $item->drink->name }}" style="width: 60px;"></td>
                                                        <td>{{ $item->drink->name }}</td>
                                                        <td>{{ $item->drink->price }}&euro;</td>
                                                    @endif
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
                                <h2>Pas de données</h2>
                            </td>
                        </tr>

                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $orders->links() }}
    </div>
@endsection

@section('scripts')
    <script>
        // On récupère la classe '.confirm' du bouton delete

        $('.confirm').click(function(event) {
            // Choisir le formulaire qui contient bouton
            let form = $(this).closest("form");

            // Empêcher le comportement par défaut du formulaire

            event.preventDefault();

            //Configuration de la boîte Alert

            Swal.fire({
                title: 'Suppression de commande',
                text: "Voulez-vous supprimer cette commande?",
                cancelButtonText: "Non",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui'
            }).then((result) => {

                //Si confirmé au niveau de la boîte alert en appuyant sur Oui

                if (result.isConfirmed) {
                    form.submit(); // On soumet le formulaire
                }
            })
        });
    </script>
@endsection
