@extends('personnel.layouts.app')
@section('title', 'Editer une boisson')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.drinks.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('personnel.drinks.update', $drink->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Editer une boisson</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Nom de la boisonn" value="{{ $drink->name }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="tiny" cols="30" rows="30" class="form-control"
                            placeholder="Description de la boisson">{{ $drink->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="price" class="form-label">Catégorie</label>
                        <select class="form-control selectric" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id === $drink->category_id ? 'selected' : '' }}>
                                    {{ $category->designation }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">
                                {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="price" class="form-label">Prix de la boisson</label>
                        <input type="number" min="0.00" max="1000.00" step="0.25" name="price"
                            class="form-control" value="{{ $drink->price }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Image</label>
                    <div class="col-sm-12">
                        <div style="background-image: url({{ asset($drink->image) }}); background-size:cover; background-position:center;"
                            id="image-preview" class="image-preview mb-2">
                            <label for="image-upload" id="image-label">Choisir un fichier</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-6">
                        <label class="form-label text-left col-12" for="available">Disponibilité</label>
                        <select class="form-control selectric" name="available" id="available">
                            <option {{ $drink->available == 1 ? 'selected' : '' }} value="1">Disponible</option>
                            <option {{ $drink->available == 0 ? 'selected' : '' }} value="0">Non Disponible</option>
                        </select>
                        @error('available')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label text-left col-12" for="canBeCommended">Commandable</label>
                        <select class="form-control selectric" name="canBeCommended" id="canBeCommended">
                            <option {{ $drink->canBeCommended == 1 ? 'selected' : '' }} value="1">Commandable</option>
                            <option {{ $drink->canBeCommended == 0 ? 'selected' : '' }} value="0">Non Commandable
                            </option>
                        </select>
                        @error('canBeCommended')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-6">
                        <label for="quantityMinimum" class="form-label">Seuil de quantité minimale</label>
                        <input type="number" id="quantityMinimum" class="form-control" name="quantityMinimum"
                            value="{{ $drink->quantityMinimum }}">
                        @error('quantityMinimum')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="quantityInStock" class="form-label">Quantité en stock</label>
                        <input type="number" id="quantityInStock" class="form-control" name="quantityInStock"
                            value="{{ $drink->quantityInStock }}">
                        @error('quantityInStock')
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
@endsection
