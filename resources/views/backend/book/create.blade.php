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
                            <form action="{{ route('backend.book.store') }}" method="post" enctype="multipart/form-data" role="form">
                                @csrf
                                <div class="mb-2">
                                    <label for="genre_id">Book Genre</label>

                                    <select name="genre_id" class="form-control @error('genre_id') is-invalid @enderror">
                                        @foreach ($genre as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
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

                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" 
                                        @error('title') is-invalid @enderror>
                                    
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="writer">Book Writer</label>

                                    <input type="text" name="writer" value="{{ old('writer') }}" class="form-control" 
                                        @error('writer') is-invalid @enderror>
                                    
                                    @error('writer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="publisher">Publisher</label>

                                    <input type="text" name="publisher" value="{{old ('publisher')}}" class="form-control" 
                                        @error('publisher') is-invalid @enderror>

                                    @error('publisher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="image">Book Image</label>

                                    <input type="file" name="image" value="{{old ('image')}}" class="form-control @error('image') is-invalid @enderror">
                                    
                                    @error ('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="description">Book Description</label>

                                    <textarea name="description" cols="30" rows="10" value="{{old ('description')}}" class="form-control @error ('description') is-invalid @enderror">{{old ('description')}}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="price">Price</label>

                                    <input type="number" name="price" value="{{old ('price')}}" class="form-control" 
                                        @error('price') is-invalid @enderror>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="stock">Stock</label>

                                    <input type="number" name="stock" value="{{old ('stock')}}" class="form-control" 
                                        @error('stock') is-invalid @enderror>

                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <input type="hidden" name="status" value="Good">
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