@extends('layouts.backend')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white">
                        <span>Orders</span>
                        <a href="{{ route('backend.orders.export.csv', request()->only(['start_date', 'end_date', 'status'])) }}" class="btn btn-sm btn-light text-dark">
                            <i class="fas fa-file-csv "></i> Export CSV
                        </a>
                        <a href="{{ route('backend.orders.export.pdf', request()->only(['start_date', 'end_date', 'status'])) }}" class="btn btn-light text-dark">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <form method="GET" action="{{ route('backend.orders.reports') }}" class="d-flex gap-2">
                            <input type="date" name="start_date" class="form-control bg-white" required>
                            <input type="date" name="end_date" class="form-control bg-white" required>

                            <select name="status" class="form-control bg-white">
                                <option value="">Show all statuses</option>
                                <option value="pending">Pending</option>
                                <option value="success">Success</option>
                            </select>
                            <button type="submit" class="btn btn-primary ">Filter</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataOrder">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Code</th>
                                        <th>User</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($order->status == 'success')
                                                <span class="badge bg-success">Success</span>
                                            @else
                                                <span class="badge bg-danger">Canceled</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#dataOrder');
    </script>
@endpush