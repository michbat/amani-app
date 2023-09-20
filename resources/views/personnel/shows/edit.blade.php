@extends('personnel.layouts.app')
@section('title', 'Editer un spectacle')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.shows.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('personnel.shows.update', $show->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Editer un spectacle</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-4">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Titre du spectacle" value="{{ $show->title }}">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="band" class="form-label">Groupe</label>
                        <select name="band_id" id="band" class="form-control selectric">
                            @foreach ($bands as $band)
                                <option value="{{ $band->id }}" @selected($show->band_id === $band->id)>
                                    {{ $band->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="agenda" class="form-label">Agenda</label>
                        <select name="isScheduled" id="agenda" class="form-control selectric">
                            <option value="1" @selected($show->isScheduled === 1)>Programmé</option>
                            <option value="0" @selected($show->isScheduled === 0)>Annulé</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Poster</label>
                    <div class="col-sm-12">
                        <div style="background-image: url({{ asset($show->poster) }}); background-size:cover; background-position:center;"
                            id="image-preview" class="image-preview mb-2">
                            <label for="image-upload" id="image-label">Choisir le fichier</label>
                            <input type="file" name="poster" id="image-upload">
                        </div>
                        @error('poster')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="fonction" class="form-label">Description</label>
                        <textarea name="description" id="tiny">{{ $show->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer mb-4">
                    <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i
                            class="fas fa-edit mx-2"></i>Editer</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
@endsection
