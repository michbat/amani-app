@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Contactez-nous</h1>
        <p>Cuisine délicieuse et démocratique</p>
    </div>
@endsection

<div>
    <div class="container margin_60_40">
        <h5 class="mb-5 text-center">Envoyez-nous un message</h5>
        <div class="row">
            <div class="col-lg-12 col-md-12 add_bottom_25">
                <div id="message-contact"></div>
                <div id="contactform">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Nom & prénom" name="name"
                            value="{{ old('name') }}" wire:model="name">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email" name="email"
                            value="{{ old('email') }}" wire:model="email">

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" style="height: 200px;" placeholder="Message" name="message" value="{{ old('message') }}"
                            wire:model="message"></textarea>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input class="form-control" type="text" name="verify" wire:model="verify"
                                placeholder="{{ $question }}">
                            @error('verify')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-lg" type="submit"
                            wire:click.prevent="sendMessage">Envoyer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
</div>
