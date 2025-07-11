@extends('layouts.backend')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Returns & Lendings Data
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="lendOrder">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Book Title</th>
                                        <th>User</th>
                                        <th>Total fines</th>
                                        <th>Status</th>
                                        <th>Book status</th>
                                        <th>Lending status</th>
                                        <th>Lend Date</th>
                                        <th>Will be returned at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returns as $return)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $return->book->title}}</td>
                                        <td>{{ $return->user->name }}</td>
                                        <td>Rp{{ number_format($return->calculateFines(), 0, ',', '.') }}</td>
                                        <td>
                                            @if ($return->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($return->status == 'success')
                                                <span class="badge bg-success">Success</span>
                                            @else
                                                <span class="badge bg-danger">Not yet approved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($return->book_status == 'bad')
                                                <span class="badge bg-warning text-dark">Bad</span>
                                            @elseif($return->book_status == 'good')
                                                <span class="badge bg-success">Good</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($return->lending_status == 'borrowed')
                                                <span class="badge bg-warning text-dark">Borrowed</span>
                                            @elseif($return->lending_status == 'returned')
                                                <span class="badge bg-success">Returned</span>
                                            @else
                                                <span class="badge bg-danger">Not yet approved</span>
                                            @endif
                                        </td>
                                        <td>{{ $return->created_at }}</td>
                                        <td>{{ $return->returned_at }}</td>
                                        <td>
                                            <a href="{{ route('backend.returns.show', $return->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                            <form action="{{ route('backend.returns.destroy', $return->id) }}" 
                                                method="POST" style="display:inline;" 
                                                onsubmit="return confirm('Are you sure you want to delete this data?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
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