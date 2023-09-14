@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Termes et conditions de vente</h1>
        <p>Cuisine délicieuse au prix démocratique</p>
    </div>
@endsection


<div>
    <main class="pattern_2">
        <div class="container margin_60_40">
            {!! $restaurant->reglement !!}
        </div>
    </main>
</div>
