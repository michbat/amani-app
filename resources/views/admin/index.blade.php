@extends('admin.layouts.app')
@section('title', 'admin index page')
@section('custom_css')
    <style>
        .col-4 a {
            text-decoration: none;
        }

        .card {
            box-shadow: 1px 2px 10px rgba(5, 5, 5, 0.5);
        }
    </style>
@endsection
@section('content')
    <div style="margin-top: 80px;">
        <div class="row" style="margin-top: 20px;">
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-primary" style="color: #333">
                        <h5 class="card-title text-center">Chiffre d'affaires</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $turnover }}
                            &euro;</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-primary" style="color: #333">
                        <h5 class="card-title text-center">TVA à payer</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $tax }}
                            &euro;</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <a href="{{ route('admin.users.index') }}">
                    <div class="card">
                        <div class="card-body bg-primary" style="color: #333">
                            <h5 class="card-title text-center">Nombre d'utilisateurs</h5>
                            <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">
                                {{ $users }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="{{ route('admin.plats.index') }}">
                    <div class="card">
                        <div class="card-body bg-info" style="color: #333">
                            <h5 class="card-title text-center">Plats à la carte</h5>
                            <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">
                                {{ $plats }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-info" style="color: #333">
                        <h5 class="card-title text-center">Boissons à la carte</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $drinks }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <a href="{{ route('admin.ingredients.index') }}">
                    <div class="card">
                        <div class="card-body bg-info" style="color: #333">
                            <h5 class="card-title text-center">Ingredients en stock</h5>
                            <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">
                                {{ $ingredients }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="{{ route('admin.orders.index') }}">
                    <div class="card">
                        <div class="card-body bg-warning" style="color: #333">
                            <h5 class="card-title text-center">Nombre de commandes passées</h5>
                            <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">
                                {{ $nbrOrders }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a href="{{ route('admin.tables.index') }}">
                    <div class="card">
                        <div class="card-body bg-warning" style="color: #333">
                            <h5 class="card-title text-center">Tables occupées</h5>
                            <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">
                                {{ $occupiedTable }} sur {{ $nbrTables }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
