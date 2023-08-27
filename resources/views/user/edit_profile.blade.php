@extends('user.layouts.app')
@section('title', 'Edit Profile Page')
@section('content')
    <section class="d-flex justify-content-center align-items-center h-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-lg-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="my-5 text-center">Editer vos données</h2>
                            <form action="{{ route('user.edit.profile.submit') }}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('firstname') is-invalid @enderror"
                                        name="firstname" placeholder="Prénom" value="{{ $user->firstname }}">
                                    @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('lastname') is-invalid @enderror"
                                        name="lastname" placeholder="Nom" value="{{ $user->lastname }}">
                                    @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('email') is-invalid @enderror"
                                        placeholder="Adresse e-mail" name="email" value="{{ $user->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('phone') is-invalid @enderror"
                                        placeholder="Votre numéro de téléphone" name="phone" value="{{ $user->phone }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success py-2 fs-5"
                                        style="min-width: 200px;">Editer</button>
                                    <a href="{{ route('user.dashboard') }}" class="link-success my-4 d-block">Revenir en
                                        arrière</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
