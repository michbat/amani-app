@extends('personnel.layouts.app')
@section('title', 'Ajouter une table')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.tables.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('personnel.tables.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Ajouter une table</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-6">
                        <label class="form-label">Code de la table</label>
                        <input type="text" class="form-control" value="TABLE-00{{ $tables + 1 }}" disabled>
                    </div>
                    <div class="col-sm-6">
                        <label for="seat" class="form-label">Places</label>
                        <input type="number" class="form-control" name="seat" id="seat"
                            placeholder="Nombre de places" value="{{ old('seat') }}">
                        @error('seat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer mb-4">
                <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i
                        class="fas fa-plus-circle mx-2"></i>Ajouter</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>

@endsection
