@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Spectacles à l'affiche</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
@push('styles')
    <style>
        .card {
            height: 100%;
        }

        .card-body {
            flex-grow: 1;
        }
    </style>
@endpush
<div>
    <main>
        <!-- /hero_single -->

        <div class="filters_full clearfix">
            <div class="container">
                <div class="form-group row">
                    <div class="col-6">

                        <label for="debut" class="form-label">Date début</label>
                        <input id="debut" type="date" min="{{ date('Y-m-d') }}" class="form-control"
                            wire:model="startDate">
                    </div>
                    <div class="col-6">
                        <label for="fin" class="form-label">Date fin</label>
                        <input id="fin" type="date" min="{{ date('Y-m-d') }}" class="form-control"
                            wire:model="endDate">
                    </div>

                </div>
                <div class="d-flex justify-content-between">
                    {{-- Filtrage par style de musique --}}
                    <div class="sort_select">
                        <select name="sort" id="sort" style="min-width: 150px;" wire:model="music_id">
                            <option value="0" selected="selected">Style de musique</option>
                            @foreach ($musics as $music)
                                <option value="{{ $music->id }}">{{ $music->style }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Filtrage par nom de show --}}
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="show"
                            placeholder="Entrez le nom du show">
                    </div>
                    {{-- Filtrage par nom de groupe --}}
                    <div class="sort_select">
                        <select name="sort" id="sort" style="min-width: 150px;" wire:model="band_id">
                            <option value="0" selected="selected">Groupes</option>
                            @foreach ($bands as $band)
                                <option value="{{ $band->id }}">{{ $band->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- /filters_full -->
        <div class="container margin_60_40">
            <div class="count_results">
                @if ($shows->count() > 0)
                    <p>
                        {{ $shows->firstItem() }} à {{ $shows->lastItem() }} sur {{ $shows->total() }} spectacle(s)
                    </p>
                @endif
            </div>
            <div class="row">
                @if (count($shows) > 0)
                    @foreach ($shows as $show)
                        <div class="col-lg-6 my-3">
                            <div class="card shadow-lg d-flex flex-column">
                                <img class="card-img-top" src="{{ asset($show->poster) }}" alt="{{ $show->title }}"
                                    width="500" height="350">
                                <div class="card-body d-flex flex-column">
                                    <h3 class="card-title text-center mb-3">{{ $show->band->name }}</h3>

                                    <h6 class="text-center">
                                        <span
                                            class="text-center mb-3 lead text-success {{ $show->isScheduled === 0 ? 'text-decoration-line-through' : '' }}">
                                            Spectacle: {{ $show->title }}
                                        </span>
                                        @if ($show->isScheduled)
                                            <small class="text-center text-primary mx-2">(En présentation)</small>
                                        @else
                                            <span class="text-center text-danger mx-2">(Annulé)</span>
                                        @endif
                                    </h6>

                                    <p class="card-text">
                                        {!! $show->description !!}
                                    </p>
                                    <div class="mb-5 mt-4" style="font-weight: 400; color: green">
                                        <div>
                                            <span>Styles de musique: </span>
                                            @foreach ($show->band->musics as $music)
                                                <span>
                                                    {{ $music->style }},
                                                </span>
                                            @endforeach
                                        </div>

                                        <div>
                                            <span>Artistes:</span>
                                            @foreach ($show->band->artists as $artist)
                                                <span>
                                                    {{ $artist->name }},
                                                </span>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="my-4 d-flex justify-content-center mt-auto">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                            data-target="#modal-{{ $show->id }}">
                                            <i class="far fa-calendar-alt mx-2"></i>Programmation
                                        </button>
                                        <!-- Button trigger modal end -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-{{ $show->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            Spectacle: {{ $show->title }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6 class="lead">Programmation: </h6>
                                                        <ul>
                                                            @foreach ($show->representations as $representation)
                                                                <li>
                                                                    <span
                                                                        class="{{ $representation->canceled === 1 || $representation->canceledThroughShow === 1 ? 'text-decoration-line-through' : '' }}">
                                                                        {{ $representation->getNameDay($representation->representationDate) }}
                                                                        {{ $representation->getRepresentationDateFormat($representation->representationDate) }}
                                                                        de {{ $representation->startTime }} à
                                                                        {{ $representation->endTime }}
                                                                    </span>
                                                                    @if ($representation->canceled === 1 || $representation->canceledThroughShow === 1)
                                                                        <span class="text-danger">
                                                                            (Annulée)
                                                                        </span>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End Modal  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center my-5">
                        <h2 class="display-3 text-center d-flex flex-column">
                            <i class="far fa-frown fa-3x"></i>
                            <span>Aucun spectacle!</span>
                        </h2>
                    </div>
                @endif
            </div>

        </div>
        @if ($shows->hasPages())
            <div class="d-flex justify-content-center">
                {{ $shows->links() }}
            </div>
        @endif
    </main>
</div>
