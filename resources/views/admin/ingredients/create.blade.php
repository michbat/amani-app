@extends('admin.layouts.app')
@section('title', 'Ajouter un ingrédient')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.ingredients.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.ingredients.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Ajouter un ingrédient</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nom de l'ingredient</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Nom du type de produits" value="{{ old('name') }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="type" class="form-label">Type de l'ingrédient</label>
                        <select class="form-control selectric" name="type_id" id="type">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="quantityInStock" class="form-label">Quantité en stock</label>
                        <input type="number" class="form-control" name="quantityInStock" id="quantityInStock" min="1" max="1000" step="1"
                            placeholder="Quantité en stock" value="{{ old('quantityInStock') }}">

                        @error('quantityInStock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="quantityMinimum" class="form-label">Quantité minimum exigée</label>
                        <input type="number" class="form-control" name="quantityMinimum" id="quantityMinimum" min="1" max="1000" step="1"
                            placeholder="Quantité minimum en stock" value="{{ old('quantityMinimum') }}">

                        @error('quantityMinimum')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="stockStatus" class="form-label">Disponibilité</label>
                        <select class="form-control selectric" name="stockStatus" id="stockStatus">
                            @foreach ($stockStatus as $status)
                                <option value="{{ $status->value }}">
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('stockStatus')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="unit" class="form-label">Unité de mesure</label>
                        <select class="form-control selectric" name="unit_id" id="unit">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">
                                    {{ $unit->name }} ({{ $unit->symbol }})
                                </option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer mb-4">
                    <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i
                            class="fas fa-plus-circle mx-2"></i>Ajouter</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>

@endsection
