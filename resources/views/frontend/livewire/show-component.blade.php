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
                                    <h6
                                        class="text-center mb-3 lead text-success {{ $show->isScheduled === 0 ? 'text-decoration-line-through' : '' }}">
                                        Spectacle: {{ $show->title }} -
                                        @if ($show->isScheduled)
                                            <small class="text-center text-warning">En présentation</small>
                                        @else
                                            <span class="text-center text-danger">Annulé</span>
                                        @endif
                                    </h6>

                                    <p class="card-text">
                                        {!! $show->description !!}
                                    </p>
                                    <div class="my-4 d-flex justify-content-center mt-auto">
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-outline-success {{ $show->isScheduled === 0 ? 'disabled' : '' }}"
                                            data-toggle="modal" data-target="#exampleModalCenter">
                                            <i class="far fa-calendar-alt mx-2"></i>Programmation
                                        </button>
                                        <!-- Button trigger modal end -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
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
