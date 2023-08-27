@extends('admin.layouts.app')
@section('title', 'User Show')

@section('content')
    <div class="mt-5 card shadow p-2 p-xl-5 mb-4 text-center position-relative overflow-hidden">
        <!-- Le profil de la carte-->

        <div class="card-body">
            <div class="banner"></div>
            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="" class="img-circle mx-auto mb-5">
            <h4 class="mb-4">
                {{ $user->firstname }} {{ $user->lastname }}
                <span class="badge badge-secondary">
                    {{ $user->status }}
                </span>
            </h4>
            <div class="text-left mb-4">
                <h5 class="mb-2"><i class="fas fa-envelope mx-2"></i>{{ $user->email }}</h5>
                <h5 class="mb-2"><i class="fas fa-phone mx-2"></i>{{ $user->phone }}</h5>
                <h5 class="mb2"><i class="fas fa-user-tag mx-2"></i>{{ $user->role->name }}</h5>
            </div>

        </div>
        <div class="card-footer">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary text-dark btn-lg"><i
                    class="fas fa-caret-left mx-2"></i>Retour à l'index</a>
        </div>
    </div>
@endsection

@section('custom_css')
    <style>
        body {
            background-color: #f5f5f5;
            font-family: "Roboto", Arial, sans-serif;
        }

        .card {
            margin: 0 auto;
            border-radius: 0 0 10px 10px;
            width: 500px;
            border-radius: 10px;
        }

        .shadow {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .banner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 180px;
            background-image: url("{{ asset('assets/img/banner.jpeg') }}");
            background-position: center;
            background-size: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .img-circle {
            position: relative;
            height: 200px;
            width: 200px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 20;
        }
    </style>
@endsection
