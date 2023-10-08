@extends('user.layouts.app')
@section('content')
    <div class="row my-4">
        <div class="col-sm-12 col-lg-4 mx-auto">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h2 class="my-5 text-center">Connexion</h2>
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="text" class="form-control py-2 @error('email') is-invalid @enderror"
                                placeholder="Adresse e-mail" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form group mb-4">
                            <input type="password" class="form-control py-2 @error('password') is-invalid @enderror"
                                placeholder="Mot de passe" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg  py-2 fs-5" style="min-width: 200px;">Se
                                connecter</button>
                            <a href="{{ route('forgot.password') }}" class="mt-3 d-block link-success">Mot de passe
                                oublié?</a>
                            <p class="mt-3 mb-5">Pas encore un compte? <a href="{{ route('register') }}"
                                    class="link-success">Cliquez
                                    ici</a></p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

