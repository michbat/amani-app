@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Notre galerie photo</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<div>
    <main>
        <div class="bg_gray">
            <div class="container margin_60_40">
                <div class="count_results">
                    @if ($photos->count() > 0)
                        <p>{{ $photos->firstItem() }} à {{ $photos->lastItem() }} sur {{ $photos->total() }} photo(s)
                        </p>
                    @endif
                </div>
                <div class="grid">
                    <ul class="magnific-gallery clearfix">
                        <div class="row">
                            @if (count($photos) > 0)
                                @foreach ($photos as $photo)
                                    <div class="col-xl-3">
                                        <div class="item">
                                            <div class="item-img" data-cue="slideInUp">
                                                <img src="{{ asset($photo->image) }}" alt="{{ $photo->title }}">
                                                <div class="content">
                                                    <a href="{{ asset($photo->image) }}" title="{{ $photo->title }}"
                                                        data-effect="mfp-zoom-in"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center align-items-center">
                                    <h2>Pas de photos</h2>
                                </div>
                            @endif
                        </div>
                    </ul>
                </div>
            </div>
            @if ($photos->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $photos->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
