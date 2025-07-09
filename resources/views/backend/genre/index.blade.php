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
                        Data Genre
                        <a href="{{ route('backend.genre.create') }}" class="btn btn-info btn-sm" style="color:white; float: right;" 
                            style="float: right;">
                            Tambah
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table" id="datagenre">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Genre Name </th>
                                        <th> Slug </th>
                                        <th> Aksi </th>

                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach ($genre as $data)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$data->name}} </td>
                                        <td> {{$data->slug}} </td>
                                        
                                        <td> 
                                            <a href="{{ route('backend.genre.edit', $data->id) }}"
                                                class="btn btn-sm btn-warning">
                                                edit
                                            </a> |

                                            <a href="{{ route('backend.genre.destroy', $data->id) }}"
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
        $('#datagenre').DataTable();
    });
    </script>
@endpush