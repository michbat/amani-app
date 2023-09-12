<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="footer_wp">
                    <i class="icon_pin_alt"></i>
                    <h3>Adresse</h3>
                    <p>
                        {{ $global->number }}, {{ $global->roadName }}<br>
                        {{ $global->postalCode }} {{ $global->city }}
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="footer_wp">
                    <i class="icon_tag_alt"></i>
                    <h3>Coordonnées</h3>
                    <p>
                        <a href="tel:{{ $global->phone }}">{{ $global->phone }}</a>
                        <a href="tel:{{ $global->gsm }}">{{ $global->gsm }}</a>
                        <a href="mailto:{{ $global->email }}">{{ $global->email }}</a>
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="footer_wp">
                    <i class="icon_clock_alt"></i>
                    <h3>Heures d'ouverture</h3>
                    <ul>
                        <li>Tous les jours de 10h à 23h00</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <h3>Réseaux sociaux</h3>
                <div class="follow_us">
                    <ul>
                        <li><a href="{{ $global->facebookLink }}"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ $global->twitterLink }}"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ $global->instagramLink }}"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 text-center">
            <p class="copy">© {{ $global->name }} Restaurant - Tous droits reservés</p>
        </div>
    </div>
    <p class="text-center"></p>
    </div>
</footer>
