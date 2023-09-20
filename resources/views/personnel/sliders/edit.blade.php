@extends('personnel.layouts.app')
@section('title', 'Eidter un slider')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('personnel.sliders.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <form action="{{ route('personnel.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Editer un slider</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="title" class="form-label">Titre du slider</label>
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Titre du slider" value="{{ $slider->title }}">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <div class="col-sm-12">
                        <label for="content" class="form-label">Contenu</label>
                        <textarea name="content" id="tiny" cols="30" rows="30" class="form-control">{{ $slider->content }}</textarea>

                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="form-label text-left col-12" for="image-upload">Image</label>
                    <div class="col-sm-12">
                        <div style="background-image: url({{ asset($slider->image) }}); background-size:cover; background-position:center;"
                            id="image-preview" class="image-preview mb-2 w-100">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
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
