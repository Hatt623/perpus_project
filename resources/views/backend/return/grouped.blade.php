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
                        <h3 class="bg-secondary text-white">Lend Code: {{ $code }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="lendCodeOrder">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Book Title</th>
                                        <th>Lending status</th>
                                        <th>Books will be returned at</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returns as $return)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $return->book->title }}</td>
                                        <td>
                                            @if ($return->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($return->status == 'success')
                                                <span class="badge bg-success">success</span>
                                            @else
                                                <span class="badge bg-danger">Not yet approved</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $return->returned_at}}
                                        </td>

                                        <td class="text-center">
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
                         <a href="{{ route('backend.returns.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to returns & lending list
                        </a>
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
        new DataTable('#lendCodeOrder');
    </script>
@endpush