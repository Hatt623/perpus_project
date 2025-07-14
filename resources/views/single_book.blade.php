@extends('layouts.frontend')

@section('content')
    <!-- breadcrumb Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__title">
                        <h3>Book</h3>

                        <ul>
                            <li><a href="/">Home</a></li>
                            <li class="color__blue">Book Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!-- Product Detail Start -->
    <div class="single__product sp_top_50 sp_bottom_80">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="featurearea__details__img">
                        <div class="featurearea__big__img">
                            <div class="featurearea__single__big__img">
                                <img src="{{Storage::url($book->image)}}"
                                    alt="{{ $book->name }}">
                            </div>
                        </div>

                        <div class="featurearea__thumb__img featurearea__thumb__img_slider_active slider__default__arrow">
                            <div class="featurearea__single__thumb__img">
                                <img src="{{Storage::url($book->image)}}"
                                    alt="{{ $book->name }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-xl-6 col-lg-6">
                    <div class="single__product__wrap">
                        <div class="single__product__heading">
                            <h2>{{ $book->title }}</h2>
                        </div>

                        <div class="single__product__price mb-2">
                            <span>Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        </div>

                        <hr>

                        <div class="single__product__description mb-3">
                            <h4>Genre: </h4></p>
                            <p>{{ $book->genre->name }}</p>
                        </div>

                        <div class="single__product__description mb-3">
                            <p><h4>Description: </h4></p>
                            <p>{{ $book->description }}</p>
                        </div>

                        <div class="single__product__special__feature mb-3">
                            <ul>
                                <li class="product__variant__inventory">
                                    <strong class="inventory__title">Availability:</strong>
                                    <span class="variant__inventory">
                                        {{ $book->stock > 0 ? $book->stock . ' left in stock' : 'Out of stock' }}
                                    </span>
                                </li>

                                {{-- <li>
                                    @php $averageRating = $book->reviews()->avg('point'); @endphp
                                    
                                    @if($averageRating)
                                        <p>Rating rata-rata: <strong>{{ number_format($averageRating, 1) }}/5</strong></p>
                                    @endif
                                </li> --}}

                            </ul>
                        </div>

                        @if ($book->stock > 0)
                        <div class="d-flex align-items-center gap-4 flex-wrap">

                            <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                @csrf
                                <div class="single__product__quantity mb-3">
                                    <div class="qty-container mb-2">
                                        <button type="button" class="qty-btn-minus btn-qty">-</button>
                                        <input type="number" name="qty" value="1" max="{{ $book->stock }}" class="input-qty">
                                        <button type="button" class="qty-btn-plus btn-qty">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="default__button">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>

                            @if ($book->status == 'Good')

                                <strong class="mx-2">Or</strong>


                                <form action="{{ route('lending.add', $book->id) }}" method="POST">
                                    @csrf
                                    <div class="single__product__quantity mb-3">
                                        <div class="qty-container mb-2">
                                            <button type="button" class="qty-btn-minus btn-qty">-</button>
                                            <input type="number" name="qty" value="1" max="{{ $book->stock }}" class="input-qty">
                                            <button type="button" class="qty-btn-plus btn-qty">+</button>
                                        </div>
                                    </div>

                                    <button type="submit" class="default__button">
                                        <i class="fas">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"  style="width: 18px; height: 18px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>    
                                        </i> Borrow it
                                    </button>
                                </form>

                            @endif
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review & Comment Section -->
    <div class="single__product sp_bottom_80">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-6">
                    {{-- <div class="border p-4 rounded shadow-sm">
                        <h5 class="mb-3">Tulis Ulasan Anda</h5>

                        @auth
                        <form action="{{ route('review.store', $book->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <div class="mb-3">
                                <label for="point" class="form-label">Rating</label>
                                <select name="point" id="point" class="form-select" required>
                                    <option value="">Pilih rating</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} Bintang</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Komentar</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirim Ulasan</button>
                        </form>
                        @else
                        <p>Silakan <a href="{{ route('login') }}">login</a> untuk memberikan ulasan.</p>
                        @endauth
                    </div> --}}
                </div>

                <!-- Display Reviews -->
                <div class="col-xl-6">
                    {{-- <div class="border p-4 rounded shadow-sm">
                        <h5 class="mb-3">Ulasan pelanggan</h5>
                        @forelse ($book->reviews as $review)
                            <div class="mb-3 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>{{ $review->user->name }}</strong>
                                    <small class="text-muted">{{ $review->created_at->format('d M, H:i') }}</small>
                                </div>
                                <div class="mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa{{ $i <= $review->point ? 's' : 'r' }} fa-star text-warning"></i>
                                    @endfor
                                </div>
                                <p class="mb-0">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
                        @endforelse
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
