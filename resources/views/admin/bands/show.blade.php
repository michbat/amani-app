@extends('admin.layouts.app')
@section('title', 'Ajout d\'un style de musique au groupe')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.bands.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h4>Les styles de musique associés à ce groupe: </h4>
            @if ($band->musics->count() > 0)
                @foreach ($band->musics as $music)
                    <form action="{{ route('admin.bands.musics.remove', [$band->id, $music->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="btn btn-success btn-sm mx-1 text-dark confirm">{{ $music->style }}</button>
                    </form>
                @endforeach
            @else
                <span>Aucun style de musique</span>
            @endif
        </div>
        <form action="{{ route('admin.bands.musics', $band->id) }}" method="POST">
            @csrf
            <div class="card-body m-3">
                <div class="form-group" id="tata">
                    <label class="form-label">Style de musique</label>
                    <select name="musics[]" class="custom-select" multiple size="20">
                        @foreach ($musics as $music)
                            <option value="{{ $music->id }}" @selected($band->hasMusic($music->style))>
                                {{ $music->style }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer mb-3 d-flex justify-content-left">
                <button type="submit" class="btn btn-primary btn-lg px-5 text-dark" style="min-width: 300px;"><i
                        class="fas fa-music mx-2"></i>Assigner les styles de musique</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script> --}}
@endsection
