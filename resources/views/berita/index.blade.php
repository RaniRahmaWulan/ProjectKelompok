@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts/_flash')
                <div class="card border-secondary">
                    <div class="card-header">
                        Data Berita
                        <a href="{{ route('berita.create') }}" class="btn btn-sm btn-primary" style="float: right">
                            Tambah Data
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Berita Detail</th>
                                        <th>Berita Singkat</th>
                                        <th>Kategori</th>
                                        <th>Nama Pembuat</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($berita as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->judul }}</td>
                                            <td>{{ $data->berita_detail }}</td>
                                            <td>{{ $data->berita_singkat }}</td>
                                            <td>{{ $data->kategori->jenis_kategori}}</td>
                                            <td>{{ $data->nama_pembuat }}</td>
                                            <td>{{ $data->tgl_dibuat }}</td>
                                            <td>
                                                <img src="{{ $data->image() }}" style="width: 100px; height:100px;"
                                                    alt="">
                                            </td>
                                            <td>
                                                <form action="{{ route('berita.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('berita.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        Edit
                                                    </a> |
                                                    <a href="{{ route('berita.show', $data->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        Show
                                                    </a> |
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Apakah Anda Yakin?')">Delete
                                                    </button>
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