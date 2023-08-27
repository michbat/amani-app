@extends('user.layouts.app')
@section('title', 'Page Forget Password')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 col-lg-6 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h2 class="my-4 text-center">Renvoyez le lien pour changer votre mot de passe</h2>
                    <form action="{{ route('resent.link.submit') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="text" class="form-control py-2 @error('email') is-invalid @enderror"
                                placeholder="Entrez l'adresse e-mail avec laquelle vous avez crée votre compte"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success py-2 fs-5 mb-3"
                                style="min-width: 200px;">Envoyer</button>
                            <a href="{{ route('login') }}" class="d-block link-success">Revenir à la page de connexion</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
