@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts._flash')
                <div class="card border-secondary">
           
                <div class="card-header mb-3">Data Kategori </div>

                    <div class="card-body">
                        <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="">Jenis Kategori</label>
                                <input type="text" name="jenis_kategori" value="{{ $kategori->jenis_kategori }}"
                                    class="form-control @error('jenis_kategori') is-invalid @enderror">
                                @error('jenis_kategori')
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