@extends('admin.layouts.app')
@section('title', 'Ajouter un groupe')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.bands.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.bands.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Ajouter un groupe de musique</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-8">
                        <label for="name" class="form-label">Nom du groupe</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom du groupe"
                            value="{{ old('name') }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="member" class="form-label">Nombre de membres</label>
                        <input type="number" class="form-control" name="member" id="member" placeholder="0" min="0" max="50"
                            value="{{ old('member') }}">

                        @error('member')
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
