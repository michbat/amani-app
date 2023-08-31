<li>
    <a href="{{ route('wishlist') }}" class="show-menu">
        Wishlist<i class="far fa-heart ms-2"></i>
        <strong>
            {{ Cart::instance('wishlist')->count() ?? 0 }}
        </strong></a>
    </a>
</li>
