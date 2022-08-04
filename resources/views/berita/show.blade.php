@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Data berita
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control " name="judul" value="{{ $berita->judul }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Berita Detail</label>
                            <textarea class="form-control" name="berita_detail" readonly>{{ $berita->berita_detail }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Berita Singkat</label>
                            <textarea class="form-control" name="berita_singkat" readonly>{{ $berita->berita_singkat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="jenis_kategori" value="{{ $berita->kategori->jenis_kategori }}"readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Pembuat</label>
                            <input type="text" class="form-control " name="nama_pembuat" value="{{ $berita->nama_pembuat }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Dibuat</label>
                            <textarea class="form-control" name="tgl_dibuat" readonly>{{ $berita->tgl_dibuat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Berita</label>
                            @if (isset($berita) && $berita->foto)
                                <p>
                                    <img src="{{ asset('images/berita/' . $berita->foto) }}" class="img-rounded img-responsive"
                                        style="width: 75px; height:75px;" alt="">
                                </p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('berita.index') }}" class="btn btn-primary" type="submit">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection