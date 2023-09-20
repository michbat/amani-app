@extends('personnel.layouts.app')
@section('title', 'Créer une catégorie')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.categories.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('personnel.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4>Création d'une catégorie</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation" id="designation"
                            placeholder="Nom de la catégorie" value="{{ old('designation') }}">

                        @error('designation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="tiny" cols="30" rows="30" class="form-control"
                            placeholder="Description de la catégorie"></textarea>

                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                        @error('image')
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
