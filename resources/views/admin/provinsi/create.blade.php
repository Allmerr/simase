@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Provinsi</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('provinsi.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="kode_provinsi" class="form-label">Kode Provinsi</label>
                        <input type="name" class="form-control" id="kode_provinsi" aria-describedby="kode_provinsi" value="{{ old('kode_provinsi') }}" name="kode_provinsi">
                    </div>
                    <div class="mb-3">
                        <label for="nama_provinsi" class="form-label">Nama Provinsi</label>
                        <input type="name" class="form-control" id="nama_provinsi" aria-describedby="nama_provinsi" value="{{ old('nama_provinsi') }}" name="nama_provinsi">
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop