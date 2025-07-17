@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Edit Genre
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.genre.update', $genre->id) }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <label for="">Nama Kategori</label>

                                    <input type="text" name="name" value="{{$genre->name}}" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <button type="submit" class="btn btn-sm btn-outline-primary"> Save </button>
                                    <button type="reset" class="btn btn-sm btn-outline-warning"> Reset </button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection