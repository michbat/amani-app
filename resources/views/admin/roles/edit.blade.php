@extends('admin.layouts.app')
@section('title', 'Editer un rôle')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.roles.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Editer un rôle</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-9">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $role->name }}">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer mb-3">
                <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i class="far fa-edit mx-2"></i>Editer</button>
            </div>
        </form>
    </div>
@endsection
