@extends('admin.layouts.app')
@section('title', 'Editer une programmation')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.representations.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    @if ($message = Session::get('warning_message'))
        <div class="alert alert-danger alert-dismissible fade show my-5" role="alert">
            <strong class="text-dark">{{ $message }}</strong>
            <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mt-3">
        <form action="{{ route('admin.representations.update', $representation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Edit une programmation</h4>
            </div>
            <div class="card-body">
                <div class="form-group row mb-4">
                    <div class="col-sm-4">
                        <label class="form-label">Lieu</label>
                        <input type="text" class="form-control" placeholder="Amani Resto" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="show" class="form-label">Nom du spectacle & groupe</label>
                        <select name="show_id" id="show" class="form-control selectric">
                            @foreach ($shows as $show)
                                <option value="{{ $show->id }}" @selected($show->id == $representation->show_id)>
                                    {{ $show->title }} -- {{ $show->band->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="canceled" class="form-label">Annulation</label>
                        <select name="canceled" id="canceled" class="form-control selectric">
                            <option value="0" @selected($representation->canceled === 0)>Non</option>
                            <option value="1" @selected($representation->canceled === 1)>Oui</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-sm-4">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" id="date" name="representationDate" class="form-control"
                            min="{{ date('Y-m-d') }}" value="{{ $representation->representationDate }}">
                        @error('representationDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="stime" class="form-label">Début</label>
                        <input type="time" id="stime" name="startTime" class="form-control"
                            value="19:30">
                        @error('startTime')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <label for="etime" class="form-label">Fin</label>
                        <input type="time" id="etime" name="endTime" class="form-control"
                            value="21:30">
                        @error('endTime')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer mb-4">
                <button type="submit" class="btn btn-primary btn-lg text-dark px-5" style="min-width: 200px;"><i
                        class="fas fa-edit mx-2"></i>Editer</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/page/features-post-create.js') }}"></script>
@endsection
