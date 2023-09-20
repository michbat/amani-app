@extends('personnel.layouts.app')
@section('title', 'Éditer une catégorie')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.categories.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('personnel.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Éditer une catégorie</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation" id="designation"
                            placeholder="Nom de la catégorie" value="{{ $category->designation }}">

                        @error('designation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="tiny" cols="100" rows="100" class="form-control"
                            placeholder="Description de la catégorie">{{ $category->description }}</textarea>

                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="my-3">

                            <img src="{{ asset($category->image) }}" alt="{{ $category->designation }}" width="200">
                        </div>
                    </div>
                </div> --}}
                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Image</label>
                    <div class="col-sm-12">
                        <div style="background-image: url({{ asset($category->image) }}); background-size:cover; background-position:center;"
                            id="image-preview" class="image-preview mb-2">
                            <label for="image-upload" id="image-label">Choisir un fichier</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer mb-3">
                <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i
                        class="far fa-edit mx-2"></i>Editer</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
@endsection
