@extends('admin.layouts.app')
@section('title', 'Ajout de tags au plat')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.plats.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h4>Les tags associés à ce plat: </h4>
            @if ($plat->tags->count() > 0)
                @foreach ($plat->tags as $tag)
                    <form action="{{ route('admin.plats.tags.remove', [$plat->id, $tag->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="btn btn-success btn-sm mx-1 text-dark confirm">{{ $tag->name }}</button>
                    </form>
                @endforeach
            @else
                <span>Aucun Tag</span>
            @endif
        </div>
        <form action="{{ route('admin.plats.tags', $plat->id) }}" method="POST">
            @csrf
            <div class="card-body m-3">
                <div class="form-group" id="tata">
                    <label class="form-label">Tags</label>
                    <select name="tags[]" class="custom-select" multiple  size="20">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @selected($plat->hasTag($tag->name))>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer mb-3 d-flex justify-content-left">
                <button type="submit" class="btn btn-primary btn-lg px-5 text-dark" style="min-width: 300px;"><i
                        class="fas fa-tags mx-2"></i>Assigner les
                    tags</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script> --}}
@endsection
