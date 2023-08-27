@extends('user.layouts.app')
@section('title', 'Edit Password Page')
@section('content')
    <section class="d-flex justify-content-center align-items-center h-100">
        <div class="container">
            <h2 class="text-center my-5">Modifier votre mot de passe</h2>
            <div class="row">
                <div class="col-sm-12 col-lg-8 mx-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4">
                            <form action="{{ route('user.edit.password.submit') }}" method="POST">
                                @csrf
                                <div class="form-group my-4">
                                    <input type="password"
                                        class="form-control py-2 @error('password_old') is-invalid @enderror"
                                        placeholder="Votre mot de passe actuel" name="password_old"
                                        value="{{ old('password_old') }}">
                                    @error('password_old')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password"
                                        class="form-control py-2  @error('password_new') is-invalid @enderror"
                                        placeholder="Votre nouveau mot de passe" name="password_new">
                                    @error('password_new')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password"
                                        class="form-control py-2 @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Confirmer votre nouveau mot de passe" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success py-2 fs-5"
                                        style="min-width: 200px;">Changer</button>
                                    <a href="{{ route('user.dashboard') }}" class="link-success my-4 d-block">Revenir en arrière</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
