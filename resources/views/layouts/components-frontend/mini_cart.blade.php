<section class="minicart">
    <div class="minicart__inner">
        <div class="minicart__wrapper">
            <div class="minicart__close__icon">
                <div class="minicart__cart__text">
                    <strong>Cart</strong>
                </div>
                <button class="minicart__close__btn">
                    <i class="fa fa-close"></i>
                </button>
            </div>

            <div class="minicart__single__wrapper">
                @forelse ($cartItems as $item)
                <div class="minicart__single">
                    <div class="minicart__single__img">
                        <a href="{{ route('book.show', $item->book->slug) }}">
                            <img src="{{ Storage::url($item->book->image) }}" alt="{{ $item->book->title }}">
                        </a>
                    </div>
                    <div class="minicart__single__close">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button title="Remove" class="minicart__close__btn"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                    <div class="minicart__single__content">
                        <h4><a href="#">{{ $item->book->name }}</a></h4>
                        <span>{{ $item->qty }} x
                            <span class="money">Rp {{ number_format($item->book->price, 0, ',', '.') }}</span>
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-center p-3">Cart Empty</p>
                @endforelse
            </div>

            @php
                $total = $cartItems->sum(fn($item) => $item->qty * $item->book->price);
            @endphp

            <div class="minicart__footer">
                <div class="minicart__subtotal">
                    <span class="subtotal__title">Subtotal:</span>
                    <span class="subtotal__amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="minicart__button">
                    <a href="{{ route('cart.index') }}" class="default__button">View Cart</a>
                    <a href="{{ route('cart.checkout') }}" class="default__button">Checkout</a>
                </div>
            </div>
        </div>

        {{-- <div class="minicart__wrapper">
            <div class="minicart__close__icon">
                <div class="minicart__cart__text">
                    <strong>Lendings</strong>
                </div>
                <button class="minicart__close__btn">
                    <i class="fa fa-close"></i>
                </button>
            </div>

            <div class="minicart__single__wrapper">
                @forelse ($lendingItems as $item)
                <div class="minicart__single">
                    <div class="minicart__single__img">
                        <a href="{{ route('book.show', $item->book->slug) }}">
                            <img src="{{ Storage::url($item->book->image) }}" alt="{{ $item->book->title }}">
                        </a>
                    </div>
                    <div class="minicart__single__close">
                        <form action="{{ route('lending.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button title="Remove" class="minicart__close__btn"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                    <div class="minicart__single__content">
                        <h4><a href="#">{{ $item->book->title }}</a></h4>
                    </div>
                </div>
                @empty
                <p class="text-center p-3">Lendings Empty</p>
                @endforelse
            </div>

            <div class="minicart__footer">
                <div class="minicart__button">
                    <a href="{{ route('cart.index') }}" class="default__button">View Lendings</a>
                    <a href="{{ route('cart.checkout') }}" class="default__button">View Returns</a>
                </div>
                <div class="cart__note__text">
                    <strong>Pickup your book at SMK Assalaam Bandung Library !</strong>
                </div>
            </div>
        </div> --}}
    </div>
</section>
    