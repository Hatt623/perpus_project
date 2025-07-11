@extends('layouts.backend')

@section('content')
<div class="container-fluid">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-white">Detail Order</h5>
        </div>

        <div class="card-body">

            <!-- Informasi Pemesan -->
            {{-- 1st line --}}
            <div class="mb-4">
                <h6 class="text-uppercase fw-bold text-muted mb-3">Order Details</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-light">
                            <strong>Name:</strong><br>{{ $return->user->name }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-light">
                            <strong>Email:</strong><br>{{ $return->user->email }}
                        </div>
                    </div>
                    {{-- 2nd line --}}
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <strong>Lend Date:</strong><br>{{ $return->created_at }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <strong>will be returned at:</strong><br>{{ $return->returned_at }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <strong>Status:</strong><br>
                            <span>
                                <span class="badge
                                    {{ $return->status == 'pending'
                                        ? 'bg-warning text-dark'
                                        : ($return->status == 'success'
                                            ? 'bg-success'
                                            : 'bg-danger') }}">
                                    {{ ucfirst($return->status) }}
                                </span>
                            </span>
                        </div>
                    </div>
                    {{-- 3rd line --}}
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <strong>Book Status:</strong><br>
                            <span>
                                <span class="badge
                                    {{ $return->book_status == 'bad'? 'bg-warning text-dark' : ($return->book_status == 'good'? 'bg-success': 'bg-danger') }}">
                                    {{ ucfirst($return->book_status) }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <strong>Lending Status:</strong><br>
                            <span>
                               @if ($return->lending_status == 'borrowed')
                                    <span class="badge bg-warning text-dark">Borrowed</span>
                                @elseif($return->lending_status == 'returned')
                                    <span class="badge bg-success">Returned</span>
                                @else
                                    <span class="badge bg-danger">Not yet approved</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light">
                            <strong>Fines:</strong><br>Rp {{ number_format($return->calculateFines(), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Ubah Status -->
            <div class="mb-4">
                <h6 class="text-uppercase fw-bold text-muted mb-3">Change statuses</h6>
                <form action="{{ route('backend.returns.updateStatus', $return->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-2">
                        <div class="col-md-10">
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $return->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="success" {{ $return->status == 'success' ? 'selected' : '' }}>Success</option>
                                {{-- <option value="cancel" {{ $return->status == 'cancel' ? 'selected' : '' }}>Cancel</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mt-3">
                        <div class="col-md-10">
                            <select name="book_status" class="form-select" required>
                                <option value="good" {{ $return->book_status == 'good' ? 'selected' : '' }}>Good</option>
                                <option value="bad" {{ $return->book_status == 'bad' ? 'selected' : '' }}>Bad</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mt-3">
                        <div class="col-md-10">
                            <select name="lending_status" class="form-select" required>
                                <option value="borrowed" {{ $return->lending_status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                                <option value="returned" {{ $return->lending_status == 'returned' ? 'selected' : '' }}>Returned</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </div>
                </form>
            </div>

            <a href="{{ route('backend.returns.group', $return->lend_code) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to returns & lending list
            </a>

        </div>
    </div>

</div>
@endsection