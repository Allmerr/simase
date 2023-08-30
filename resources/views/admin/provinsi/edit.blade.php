@extends('adminlte::page')

@section('title', 'AdminLTE')

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
                        <label for="kode" class="form-label">Kode Provinsi</label>
                        <input type="name" class="form-control" id="kode" aria-describedby="kode" value="{{ old('kode', $provinsi->kode) }}" name="kode">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Provinsi</label>
                        <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ old('nama', $provinsi->nama) }}" name="nama">
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

