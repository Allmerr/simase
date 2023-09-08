@extends('adminlte::page')

@section('title', 'SIMASE | Edit Provinsi')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Provinsi</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('provinsi.update', $provinsi->id_provinsi) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="kode_provinsi" class="form-label">Kode Provinsi</label>
                        <input type="name" class="form-control @error('kode_provinsi')" id="kode_provinsi" aria-describedby="kode_provinsi" value="{{ old('kode_provinsi', $provinsi->kode_provinsi) }}" name="kode_provinsi" readonly>
                        @error('kode_provinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                        <input type="name" class="form-control @error('nama_provinsi')" id="nama_provinsi" aria-describedby="nama_provinsi" value="{{ old('nama_provinsi', $provinsi->nama_provinsi) }}" name="nama_provinsi" required>
                        @error('nama_provinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('provinsi.index') }}" class="btn btn-warning w-100">Kembali</a>
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

