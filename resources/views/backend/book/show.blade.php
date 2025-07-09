@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Book Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Book Genre:</strong></label>
                                <div>{{ $book->genre->name ??'--' }}</div>
                            </div>
                            <div class="mb-3">
                                <label><strong>Book Title:</strong></label>
                                <div>{{$book->title}}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Book Writer:</strong></label>
                                <div>{{ $book->writer }}</div>
                            </div>
                            <div class="mb-3">
                                <label><strong>Book Publisher:</strong></label>
                                <div>{{ $book->publisher }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Book Image:</strong></label><br>
                                @if($book->image)
                                    <img src="{{ Storage::url($book->image) }}" alt="Book Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div>Book has no image</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Book Price:</strong></label>
                                <div>Rp {{ number_format($book->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Book Status:</strong></label>
                                <span>
                                    <span class="badge {{ $book->status == 'Good' ? 'bg-success text-dark': 'bg-warning text-dark' }}">
                                        {{ ucfirst($book->status) }}
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Book Stock:</strong></label>
                                <div>{{ number_format($book->stock, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('backend.book.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Previous
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection