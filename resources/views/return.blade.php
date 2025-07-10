@extends('layouts.frontend')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb__title">
                    <h1>My Returns & Lendings</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="color_blue">Returns & Lendings</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- orders_section_start -->
<div class="cartarea sp_top_100 sp_bottom_100">
    <div class="container">
        <h4 class="mb-4">Order History</h4>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="thead-dark bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Book title</th>
                        <th>WIll be returned at</th>
                        <th>Fines</th>
                        <th>status</th>
                        <th>Book Status</th>                        
                        <th>lending status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($returns as $return)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$return->book->title}}</td>
                        <td>{{ $return->returned_at }}</td>
                        <td>Rp {{ number_format($return->calculateFines(), 0, ',', '.') }}</td>
                        <td>
                            @if ($return->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif ($return->status == 'success')
                                <span class="badge bg-warning">success</span>
                            @endif
                        </td>
                        <td>
                            @if ($return->book_status == 'bad')
                                <span class="badge bg-danger text-dark">Bad</span>
                            @elseif ($return->book_status == 'good')
                                <span class="badge bg-success">Good</span>
                            @endif
                        </td>
                        <td>
                            @if ($return->lending_status == 'returned')
                                <span class="badge bg-success text-dark">Bad</span>
                            @elseif ($return->lending_status == 'borrowed')
                                <span class="badge bg-warning">Borrowed</span>
                            @else
                                <span class="badge bg-danger">Not yet approved</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('return.show', $return->id) }}" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No Returns yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- orders_section_end -->
@endsection