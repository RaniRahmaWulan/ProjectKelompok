@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts._flash')
                <div class="card border-secondary">
                    <div class="card-header mb-3">Data Siswa
                        <a href="{{ route('kategori.create') }}"
                            class="btn btn-sm btn-primary" style="float: right;">Add Data
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <td>no</td>
                                        <th>Jenis Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($kategori as $data)
                                        <tr>
                                        <td>{{ $no++ }}</td>
                                            <td>{{ $data->jenis_kategori }}</td>
                                            <td>
                                                <form action="{{ route('kategori.destroy', $data->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <a href="{{ route('kategori.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-warning">Edit
                                                    </a> |
                                    
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are You Sure?')">Delete</button>
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