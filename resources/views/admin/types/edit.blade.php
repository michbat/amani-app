@extends('admin.layouts.app')
@section('title', 'Editer un type d\'ingrédients')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.types.index') }}"><i class="fas fa-clipboard-list mx-2"></i>Revenir
            à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Editer un type d'ingrédients</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nom du type d'ingrédients</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom du type d'ingrédients"
                            value="{{ $type->name }}">

                        @error('name')
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
