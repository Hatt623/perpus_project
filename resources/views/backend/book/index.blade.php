@extends('layouts.backend')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Data Book
                        <a href="{{ route('backend.book.create') }}" class="btn btn-info btn-sm" style="color:white; float: right;" 
                            style="float: right;">
                            Tambah
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table" id="databook">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Genre </th>
                                        <th> Title </th>
                                        <th> Slug </th>
                                        <th> Writer </th>
                                        <th> Publisher </th>
                                        <th> Image </th>
                                        <th> Description </th>
                                        <th> Price </th>
                                        <th> Stock </th>
                                        <th> Status </th>         
                                        <th></th>                             
                                        <th>Action</th>
                                        <th></th>

                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach ($book as $data)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$data->genre->name}} </td>
                                        <td> {{$data->title}} </td>
                                        <td> {{$data->slug}} </td>
                                        <td> {{$data->writer}} </td>
                                        <td> {{$data->publisher}} </td>
                                        <td> <img src="{{ Storage::url($data->image) }}" alt="{{ $data->title }}" style="width: 60px; height: auto;"> </td>
                                        <td> {{Str::limit($data->description)}} </td>
                                        <td> {{$data->price}} </td>
                                        <td> {{$data->stock}} </td>
                                        <td> {{$data->status}} </td>
                                        
                                        <td> 
                                            <a href="{{ route('backend.book.show', $data->id) }}"
                                                class="btn btn-sm btn-success">
                                                show
                                            </a>
                                        </td>
                                        
                                        <td> 
                                            <a href="{{ route('backend.book.edit', $data->id) }}"
                                                class="btn btn-sm btn-warning">
                                                edit
                                            </a> 
                                        </td>
                                        
                                        <td> 
                                            <a href="{{ route('backend.book.destroy', $data->id) }}"
                                                class="btn btn-sm btn-danger"
                                                data-confirm-delete="true">
                                                delete
                                            </a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#databook').DataTable();
    });
    </script>
@endpush