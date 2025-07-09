@extends('layouts.frontend')
@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb__title">
                    <h3>Lending</h3>
                    <ul>    
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="color__blue">Lending</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- cart area start -->
<div class="cartarea sp_bottom_100 sp_top_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="cartarea__table__content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Books</th>
                                <th>Quantity</th>
                                <th>Update</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lendingItems as $item)
                            <tr>
                                <td class="cartarea__product__thumbnail">
                                    <a href="#">
                                        <img src="{{ Storage::url($item->book->image)}}"
                                            alt="{{ $item->book->name }}" width="80">
                                    </a>
                                </td>
                                <td class="cartarea__product__name">
                                    <a href="#">{{ $item->book->title }}</a>
                                </td>
                                <td class="cartarea__product__price__cart">
                                    <span class="amount">
                                        Rp {{ number_format($item->book->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="cartarea__product__quantity">
                                    <form action="{{ route('lending.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <input type="number" name="qty" value="{{ $item->qty }}"
                                                class="form-control-sm" min="1"
                                                max="{{ $item->book->stock }}" style="max-width: 70px;">
                                            <button type="submit"
                                                class="btn btn-success btn-sm ml-2">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="cartarea__product__remove">
                                    <form action="{{ route('lending.remove', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Remove this book from lending?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Lending still empty.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Continue Shopping -->
        <div class="row">
            <div class="col-xl-12">
                <div class="cartarea__shipping__Update__wrapper">
                    <div class="cartarea__shipping__update">
                        <a class="default__button" href="{{ route('lending.lend') }}">Proceed to Lend</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
