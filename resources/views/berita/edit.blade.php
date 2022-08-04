@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts/_flash')
                <div class="card">
                    <div class="card-header">
                        Data Berita
                    </div>
                    <div class="card-body">
                        <form action="{{ route('berita.update', $berita->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control  @error('judul') is-invalid @enderror"
                                    name="judul" value="{{ $berita->judul }}">
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Berita Detail</label>
                                <textarea class="form-control  @error('berita_detail') is-invalid @enderror" name="berita_detail">{{ $berita->berita_detail }}</textarea>
                                @error('berita_detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Berita Singkat</label>
                                <textarea class="form-control  @error('berita_singkat') is-invalid @enderror" name="berita_singkat">{{ $berita->berita_singkat }}</textarea>
                                @error('berita_singkat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror"
                                    id="">
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id}}">{{ $data->jenis_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Pembuat</label>
                                <input type="text" class="form-control  @error('nama_pembuat') is-invalid @enderror"
                                    name="nama_pembuat" value="{{ $berita->nama_pembuat }}">
                                @error('nama_pembuat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Dibuat</label>
                                <input type="date" class="form-control  @error('tgl_dibuat') is-invalid @enderror"
                                    name="tgl_dibuat" value="{{ $berita->tgl_dibuat }}">
                                @error('tgl_dibuat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto berita</label>
                                @if (isset($berita) && $berita->foto)
                                    <p>
                                        <img src="{{ asset('images/berita/' . $berita->foto) }}"
                                            class="img-rounded img-responsive" style="width: 75px; height:75px;"
                                            alt="">
                                    </p>
                                @endif
                                <input type="file" class="form-control  @error('foto') is-invalid @enderror"
                                    name="foto" value="{{ $berita->foto }}">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection