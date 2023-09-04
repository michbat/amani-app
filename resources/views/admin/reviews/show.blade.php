@extends('admin.layouts.app')
@section('title', 'Voir un commentaire')

@section('content')
    <div class="d-flex mt-5 justify-content-end">
        <a class="btn btn-info btn-lg text-dark" href="{{ route('admin.reviews.index') }}"><i
                class="fas fa-clipboard-list mx-2"></i>Revenir à l'index</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Commentaire</h4>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-3">
                    <label class="form-label">Commentateur</label>
                    <input type="text" class="form-control"
                        value="{{ $review->user->firstname }} {{ $review->user->lastname }}" disabled>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Date et heure de publication</label>
                    <input type="text" class="form-control" value="{{ $review->created_at->format('d/m/Y à H:i:s') }}"
                        disabled>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Publiée</label>
                    <input type="text" class="form-control"
                        @if ($review->published === 0) value = "Non publiée"
                        @else
                            value = "Publiée" @endif
                        disabled>
                </div>
                <div class="col-sm-3">
                    <label class="form-label">Censurée</label>
                    <input type="text" class="form-control"
                        @if ($review->censored === 0) value = "Non censurée"
                        @else
                            value = "censurée" @endif
                        disabled>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Menu</label>
                    <input type="text" class="form-control" value="{{ $review->menu->name }}" disabled>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Rating</label>
                    <input type="text" class="form-control" value="{{ $review->rating }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" value="{{ $review->title }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label class="form-label">Commentaire</label>
                    <textarea cols="30" rows="30" class="form-control" disabled>{{ $review->comment }}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center my-5">
                <a href="{{ route('admin.reviews.publish', $review->id) }}"
                    class="btn btn-primary btn-lg text-dark px-5 mx-4 {{ $review->censored === 1 ? 'disabled' : '' }}"
                    style="min-width: 200px;"><i class="fas fa-check mx-2"></i>Publier</a>
                <a href="{{ route('admin.reviews.censor', $review->id) }}"
                    class="btn btn-danger btn-lg text-dark px-5 {{ $review->censored === 1 ? 'disabled' : '' }}"
                    style="min-width: 200px;"><i class="far fa-window-close mx-2"></i>Censurer</a>
            </div>

        </div>
    </div>
@endsection
