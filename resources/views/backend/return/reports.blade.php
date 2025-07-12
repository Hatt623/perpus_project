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
                        <span>Returns & Lendings Data</span>
                        <a href="{{ route('backend.returns.export.csv', request()->only(['start_date', 'end_date', 'status'])) }}" class="btn btn-sm btn-light text-dark">
                            <i class="fas fa-file-csv "></i> Export CSV
                        </a>
                        <a href="{{ route('backend.returns.export.pdf', request()->only(['start_date', 'end_date', 'status'])) }}" class="btn btn-light text-dark">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <form method="GET" action="{{ route('backend.returns.reports') }}" class="d-flex gap-2">
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
                            <table class="table" id="lendOrder">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Lending code</th>
                                        <th>Status</th>
                                        <th>Lend Date</th>
                                        <th>Will be returned at</th>
                                        <th>Total fines</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returns as $return)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $return->user->name }}</td>
                                        <td>{{ $return->lend_code }}</td>
                                        <td>
                                            @if ($return->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($return->status == 'success')
                                                <span class="badge bg-success">Success</span>
                                            @else
                                                <span class="badge bg-danger">Not yet approved</span>
                                            @endif
                                        </td>
                                        <td>{{ $return->created_at }}</td>
                                        <td>{{ $return->returned_at }}</td>
                                        <td>Rp{{ number_format($return->calculateFines(), 0, ',', '.') }}</td>
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
        new DataTable('#lendOrder');
    </script>
@endpush