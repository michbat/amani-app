@extends('admin.layouts.app')
@section('title', 'Editer un tag')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.restaurants.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir
            à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Editer les informations du restaurant</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom du tag"
                            value="{{ $restaurant->name }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-6">
                        <label for="phone" class="form-label">Numéro fixe</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Numéro Fixe"
                            value="{{ $restaurant->phone }}">

                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="gsm" class="form-label">GSM</label>
                        <input type="text" class="form-control" name="gsm" id="gsm" placeholder="Numéro de GSM"
                            value="{{ $restaurant->gsm }}">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-6">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="text" class="form-control" name="email" id="email"
                            placeholder="Adresse e-mail" value="{{ $restaurant->email }}">

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="roadName" class="form-label">Nom de la rue</label>
                        <input type="text" class="form-control" name="roadName" id="roadName"
                            placeholder="Nom de la rue" value="{{ $restaurant->roadName }}">

                        @error('roadName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-2">
                        <label for="number" class="form-label">Numéro de rue</label>
                        <input type="number" class="form-control" name="number" id="number" placeholder="Numéro de rue"
                            value="{{ $restaurant->number }}">

                        @error('number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-5">
                        <label for="postalCode" class="form-label">Adresse Postale</label>
                        <input type="text" class="form-control" name="postalCode" id="postalCode"
                            placeholder="Adresse Postale" value="{{ $restaurant->postalCode }}">

                        @error('postalCode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-5">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="Ville"
                            value="{{ $restaurant->city }}">

                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-4">
                        <label for="facebookLink" class="form-label">Facebook</label>
                        <input type="text" class="form-control" name="facebookLink" id="facebookLink"
                            placeholder="Lien facebook" value="{{ $restaurant->facebookLink }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="twitterLink" class="form-label">Facebook</label>
                        <input type="text" class="form-control" name="twitterLink" id="twitterLink"
                            placeholder="Lien Twitter" value="{{ $restaurant->twitterLink }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="instagramLink" class="form-label">Instagram</label>
                        <input type="text" class="form-control" name="instagramLink" id="instagramLink"
                            placeholder="Lien Instagram" value="{{ $restaurant->instagramLink }}">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label class="form-label">À propos</label>
                        <textarea name="aboutUs" id="tiny" cols="30" rows="30" class="form-control">{{ $restaurant->aboutUs }}</textarea>

                        @error('aboutUs')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer mb-4">
                <button type="submit" class="btn btn-primary btn-lg px-5 text-dark" style="min-width: 200px;"><i
                        class="fas fa-edit mx-2"></i>Editer</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#tiny'
        });
    </script>
@endsection
