@extends('personnel.layouts.app')
@section('title', 'Ajouter un membre du personnel')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.staffs.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('personnel.staffs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4>Ajouter un membre du personnel</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nom et prénom</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Nom & prénom" value="{{ old('name') }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Image</label>
                    <div class="col-sm-12">
                        <div id="image-preview" class="image-preview mb-2">
                            <label for="image-upload" id="image-label">Choisir le fichier</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="fonction" class="form-label">Fonction</label>
                        <input type="text" class="form-control" name="fonction" id="fonction"
                            placeholder="Fonction" value="{{ old('fonction') }}">

                        @error('fonction')
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
