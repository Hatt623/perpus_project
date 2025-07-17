@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Add Books
                    </div>
                        <div class="card-body">
                            <form action="{{ route('backend.book.update', $book->id) }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                @method('put')
                                <div class="mb-2">
                                    <label for="genre_id">Book Genre</label>

                                    <select name="genre_id" class="form-control @error('genre_id') is-invalid @enderror">
                                        @foreach ($genre as $data)
                                            <option value="{{ $data->id }}" {{ $data->id == $book->category_id ? 'selected' : '' }}>{{ $data->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('genre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="mb-2">
                                    <label for="title">Book Title</label>

                                    <input type="text" name="title" value="{{$book->title}}" class="form-control @error('title') is-invalid @enderror">
                                    
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="writer">Book Writer</label>

                                    <input type="text" name="writer" value="{{$book->writer}}" class="form-control @error('writer') is-invalid @enderror">
                                    
                                    @error('writer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="publisher">Publisher</label>

                                    <input type="text" name="publisher" value="{{$book->publisher}}" class="form-control @error('publisher') is-invalid @enderror">

                                    @error('publisher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    @if($book->image)
                                        <label for="image">Book Image</label>
                                        <img src="{{ Storage::url($book->image) }}" alt="" style="width: 100px; height:100px;">
                                    @endif

                                    <br>
                                    <label for="image">Book Image</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    <small class="text-muted">Leave blank if no changes</small>
                                    
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="description">Book Description</label>

                                    <textarea name="description" cols="30" rows="10" class="form-control @error ('description') is-invalid @enderror">{{$book->description}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="price">Price</label>

                                    <input type="number" name="price" value="{{$book->price}}" class="form-control @error('price') is-invalid @enderror">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="stock">Stock</label>

                                    <input type="number" name="stock" value="{{$book->stock}}" class="form-control @error('stock') is-invalid @enderror">

                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <input type="hidden" name="status" value="Good">
                                </div>

                                <div class="mb-2">
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="{{$book->status}}">{{$book->status}} (Previously choosed)</option>
                                        <option value="Good">Good</option>
                                        <option value="Bad">Bad</option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
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