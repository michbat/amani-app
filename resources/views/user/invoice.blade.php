<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .card {
            font-family: Arial, Helvetica, sans-serif;
            max-width: 1800px;
            margin: 0 auto;
        }

        .card-header {
            background-color: #fff;
        }

        .card-footer {
            background-color: #fff;
        }

        p {
            font-size: 20px;
            font-weight: 600;
        }

        .table th,
        td {
            text-align: center;
        }

        .table th {
            background-color: #4CAF50;
            color: white
        }
    </style>

</head>

<body>
    {{-- <div class="container"> --}}
    <h2 class="text-center my-5 display-6">Facture</h2>
    <div class="card">
        <div class="card-header d-flex justify-content-between p-4">
            <div>
                @if (auth()->user() && auth()->user()->firstname == 'Generic')
                    <p>Entreprise: Amani SRL</p>
                @else
                    <p>Nom: {{ $order->user->lastname }}</p>
                    <p>Prénom: {{ $order->user->firstname }}</p>
                @endif
                <p>Date de la Commande: {{ $order->created_at->format('d/m/Y') }}</p>
                <p>Numéro de la commande: COM-00{{ $order->id }}</p>
            </div>
        </div>
        <div class="card-body p-4">
            <table class="table table-striped inv">
                <thead>
                    <tr>
                        <th>Produit(s)</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->lineOrders as $item)
                        @if ($item->plat)
                            <tr>
                                <td>
                                    <span>{{ $item->plat->name }}</span>
                                </td>

                                <td>
                                    <span>{{ $item->plat->price }} &euro;</span>
                                </td>

                                <td>
                                    <span>{{ $item->quantity }}</span>
                                </td>
                                <td>
                                    <span>{{ $item->sellPrice }} &euro;</span>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>
                                    <span>{{ $item->drink->name }}</span>
                                </td>

                                <td>
                                    <span>{{ $item->drink->price }} &euro;</span>
                                </td>

                                <td>
                                    <span>{{ $item->quantity }}</span>
                                </td>
                                <td>
                                    <span>{{ $item->sellPrice }} &euro;</span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer p-4 d-flex flex-column justify-content-end align-items-end">
            <p>Sous-total: {{ $order->subtotal }} &euro;</p>
            <p>TVA: {{ $order->tva }} &euro;</p>
            <p>Total: {{ $order->total }} &euro;</p>
            <p>Moyen de paiement: {{ $order->paymentMode->label() }}</p>
        </div>
    </div>
    {{-- </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>
</body>

</html>
