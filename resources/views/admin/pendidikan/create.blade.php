@extends('adminlte::page')

@section('title', 'SI-MASE | Tambah Pendidikan')

@section('content_header')
    <h1 class="m-0">Tambah Pendidikan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pendidikan.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="kode_pendidikan" class="form-label">Kode pendidikan</label>
                        <input type="name" class="form-control" id="kode_pendidikan" aria-describedby="kode_pendidikan" value="{{ old('kode_pendidikan') }}" name="kode_pendidikan" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pendidikan" class="form-label">Nama pendidikan</label>
                        <input type="name" class="form-control" id="nama_pendidikan" aria-describedby="nama_pendidikan" value="{{ old('nama_pendidikan') }}" name="nama_pendidikan" required>
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('pendidikan.index') }}" class="btn btn-warning w-100">Kembali</a>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
