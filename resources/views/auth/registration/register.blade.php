@extends('user.layouts.app')
@section('content')
    <section class="d-flex justify-content-center align-items-center h-100">
        <div class="container">
            <div class="row my-5">
                <div class="col-12 col-sm-8 col-lg-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="my-5 text-center">Créer un compte</h2>
                            <form action="{{ route('register.submit') }}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('firstname') is-invalid @enderror"
                                        name="firstname" placeholder="Prénom" value="{{ old('firstname') }}">
                                    @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('lastname') is-invalid @enderror"
                                        name="lastname" placeholder="Nom" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('email') is-invalid @enderror"
                                        placeholder="Adresse e-mail" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('phone') is-invalid @enderror"
                                        placeholder="Votre numéro de téléphone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password"
                                        class="form-control py-2  @error('password') is-invalid @enderror"
                                        placeholder="Mot de passe" name="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password"
                                        class="form-control py-2 @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Confirmer le mot de passe" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <span class="text-danger mb-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success py-2 fs-5"
                                        style="min-width: 200px;">Créer</button>
                                    <p class="my-4 d-block">Avez-vous déjà un compte? <a href="{{ route('login') }}"
                                            class="link-success">Connectez-vous</a></p>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
