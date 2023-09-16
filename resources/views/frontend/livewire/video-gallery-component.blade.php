@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Notre galerie vidéo</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection
<div>
    <main>
        <div class="bg_gray">
            <div class="container margin_60_40">
                <div class="count_results">
                    @if ($videos->count() > 0)
                        <p>{{ $videos->firstItem() }} à {{ $videos->lastItem() }} sur {{ $videos->total() }} vidéo(s)
                        </p>
                    @endif
                </div>
                <div class="grid">
                    <ul class="magnific-gallery clearfix">
                        <div class="row">
                            @if (count($videos) > 0)
                                @foreach ($videos as $video)
                                    <div class="col-xl-3">
                                        <div class="item">
                                            <div class="item-img" data-cue="slideInUp">
                                                <img src="{{ asset($video->image) }}" alt="{{ $video->title }}" />
                                                <div class="content">
                                                    <a href="https://www.youtube.com/watch?v={{ $video->videoId }}"
                                                        class="video" title="{{ $video->title }}"><i
                                                            class="fas fa-play"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center align-items-center">
                                    <h2>Pas de vidéos</h2>
                                </div>
                            @endif
                        </div>
                    </ul>
                </div>
            </div>
            @if ($videos->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $videos->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
