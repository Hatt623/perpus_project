@extends('layouts.frontend')

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb_title">
                    <h1>Returns & Lendings Details</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>/</li>
                        <li><a href="{{ route('orders.index') }}">Returns & Lendings</a></li>
                        <li class="color_blue">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- order detail section -->
<div class="cartarea sp_top_100 sp_bottom_100">
    <div class="container">
        <div class="mb-4">
            <h4>Returns & Lendings Information</h4>
            <p><strong>Book Title:</strong> {{ $return->book->title }}</p>
            <p><strong>Status:</strong>
                @if ($return->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif ($return->status == 'success')
                    <span class="badge bg-success">Success</span>
                @else
                    <span class="badge bg-danger">Canceled</span>
                @endif
            </p>
            <p><strong>Lending Date:</strong> {{ $return->created_at }}</p>
            <p><strong>Will be returned at:</strong> {{ $return->returned_at }}</p>
            <p><strong>Total fines:</strong> Rp {{ number_format($return->fines, 0, ',', '.') }}</p>
        </div>

        <div class="table-responsive">
            <h4>Book</h4>
            <table class="table table-bordered text-center align-middle">
                <thead class="thead-dark bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returns as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->book->title }}</td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('return.index') }}" class="btn btn-secondary">« Back to returns & lendings</a>
        </div>
    </div>
</div>
@endsection