@extends('admin.layouts.app')
@section('title', 'Ajouter un média dans la galerie')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.galleries.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4>Ajouter un média dans la galerie</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="title" class="form-label">Titre du média</label>
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Titre du média" value="{{ old('title') }}">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Image</label>
                    <div class="col-sm-12">
                        <div id="image-preview" class="image-preview mb-2">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="galleryType" class="form-label">Type de médias</label>
                        <select class="form-control selectric" name="galleryType" id="galleryType">
                            @foreach ($types as $type)
                                <option value="{{ $type->value }}">
                                    {{ $type->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('galleryType')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4 d-none" id="video">
                    <div class="col-sm-12">
                        <label for="videoId" class="form-label">L'ID de la vidéo</label>
                        <input type="text" class="form-control" name="videoId" placeholder="L'ID de la vidéo"
                            value="{{ old('videoId') }}">

                        @error('videoId')
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
    <script>
        $(document).ready(function() {

            // Au changement, on vérifie si la valeur de la select box est 'Vidéo', auquel cas on fait apparaît l'input pour saisir l'ID de la vidéo.

            const val = $('#type').val(); // On récupère la valeur

            // On vérifié si cette valeur est égale à 'video'

            if (val == 'video') {
                $('#video').removeClass(
                    'd-none'
                    ); // Si val == video, on enlève la classe display-none (d-none) à l'input donc on le fait apparaître.
            }

            // Si on change de valeur dans la select box

            $('#type').on('change', function() {
                const val_bis = $(this).val(); // On récupère la valeur choisie
                if (val_bis == 'video') {
                    // Si c'est 'video', on enlève la classe d-none à l'input qui apparaît
                    $('#video').removeClass('d-none');
                } else {
                    // Sinon, on remet la classe d-none qui fait disparaître l'input
                    $('#video').addClass('d-none');
                }
            });
        })
    </script>

@endsection
