@extends('admin.layouts.app')
@section('title', 'Créer un rôle')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info text-dark btn-lg" href="{{ route('admin.roles.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Ajout d'un role</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-9">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom du rôle"
                            value="{{ old('name') }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer mb-3">
                <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i
                        class="fas fa-plus-circle mx-2"></i>Ajouter</button>
            </div>
        </form>
    </div>
@endsection
