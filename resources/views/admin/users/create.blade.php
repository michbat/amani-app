@extends('admin.layouts.app')
@section('title', 'User Create')

@section('content')
    <div class="card mt-5">
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary text-dark"><i
                    class="fas fa-caret-left mx-2"></i>Revenir à l'index</a>
        </div>
        <div class="card-body">
            <div class="container">
                <form class="form-signup" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <h2 class="text-center py-5">Ajouter un compte d'utilisateur</h2>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control py-2 @error('firstname') is-invalid @enderror"
                                    name="firstname" placeholder="Prénom" value="{{ old('firstname') }}">
                                @error('firstname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <input type="text" class="form-control py-2 @error('lastname') is-invalid @enderror"
                                        name="lastname" placeholder="Nom" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control py-2 @error('email') is-invalid @enderror"
                            placeholder="Adresse e-mail" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control py-2 @error('phone') is-invalid @enderror"
                            placeholder="Votre numéro de téléphone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-center my-5">
                        <button type="submit" class="btn btn-primary btn-block py-2 fs-5 text-dark"
                            style="min-width: 200px;"><i class="fas fa-plus-circle mx-2"></i>Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_css')
    <style>
        .card {
            max-width: 800px !important;
            margin: 0 auto;
            box-shadow: 5px 8px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px
        }

        .form-signup {
            margin: 0 auto;
            max-width: 600px;
        }
    </style>

@endsection
