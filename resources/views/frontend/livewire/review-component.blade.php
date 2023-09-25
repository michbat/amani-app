@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Commentaires</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection

<div>
    <main class="pattern_2">
        <div class="container margin_60_40">
            @if ($message = Session::get('warning_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="write_review">
                        <h1>Écrivez un commentaire</h1>
                        <p style="color: red; font-size: 12px;">(Tout commentaire
                            hors-sujet ou contenant des propos inconvenants ne sera pas publié! Avec 5 messages
                            censurés, vous ne pouvez plus commenter!)</p>
                        <h6><a href="{{ route('details', $plat->slug) }}" title="Revenir en arrière">Plat concerné:
                                {{ $plat->name }}</a></h6>
                        <p>
                            <a href="{{ route('details', $plat->slug) }}" title="Revenir en arrière">
                                <img src="{{ asset($plat->image) }}" alt="{{ $plat->name }}" width="150">
                            </a>
                        </p>
                        <div class="write_review">
                            <div class="rating_submit">
                                <div class="form-group mb-2">
                                    <label class="d-block">Avis<span class="text-danger">*</span></label>
                                    <span class="rating mb-0">
                                        <input type="radio" class="rating-input" id="5_star" name="rating-input"
                                            value="5" wire:model="rating"><label for="5_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="4_star" name="rating-input"
                                            value="4" wire:model="rating"><label for="4_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="3_star" name="rating-input"
                                            value="3" wire:model="rating"><label for="3_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="2_star" name="rating-input"
                                            value="2" wire:model="rating"><label for="2_star"
                                            class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="1_star" name="rating-input"
                                            value="1" wire:model="rating"><label for="1_star"
                                            class="rating-star"></label>
                                    </span>
                                </div>
                                @error('rating')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- /rating_submit -->
                            <div class="form-group">
                                <label>Titre de votre commentaire <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Maximum 30 caractères"
                                    wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label>Votre commentaire <span class="text-danger">*</span></label>
                                <textarea class="form-control" style="height: 280px;" placeholder="Maximum 300 caractères" wire:model="comment"></textarea>
                                @error('comment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" wire:click.prevent="postReview"
                                    class="btn btn-success {{ $alreadyCommented != null || auth()->user()->censoredCommments >= 5? 'disabled' : '' }}">Envoyez</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row --
        </div>
        <!-- /container -->
    </main>
</div>
