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
                                        <th>Action</th>
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
                                        <td>{{ $return->created_at->format('d M Y, H:i') }}</td>
                                        <td>{{ $return->returned_at->format('d M Y, H:i') }}</td>
                                        <td>Rp{{ number_format($return->calculateFines(), 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('backend.returns.group', $return->lend_code) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                        </td>
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