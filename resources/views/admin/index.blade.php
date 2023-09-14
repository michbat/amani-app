@extends('admin.layouts.app')
@section('title', 'admin index page')
@section('content')
    <div style="margin-top: 80px;">
        <div class="row" style="margin-top: 20px;">
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-primary" style="color: #333">
                        <h5 class="card-title text-center">Chiffre d'affaires</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $turnover }} &euro;</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-primary" style="color: #333">
                        <h5 class="card-title text-center">TVA à payer</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $tax }} &euro;</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-primary" style="color: #333">
                        <h5 class="card-title text-center">Nombre d'utilisateurs</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $users }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-info" style="color: #333">
                        <h5 class="card-title text-center">Plats à la carte</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $plats }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-info" style="color: #333">
                        <h5 class="card-title text-center">Boissons à la carte</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $drinks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-info" style="color: #333">
                        <h5 class="card-title text-center">Ingredients en stock</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $ingredients }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body bg-warning" style="color: #333">
                        <h5 class="card-title text-center">Nombre de commandes passées</h5>
                        <p class="card-text text-center" style="font-weight: bolder; font-size: 20px;">{{ $nbrOrders }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
