@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Create Pendidikan</h1>
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
                        <input type="name" class="form-control" id="kode_pendidikan" aria-describedby="kode_pendidikan" value="{{ old('kode_pendidikan') }}" name="kode_pendidikan">
                    </div>
                    <div class="mb-3">
                        <label for="nama_pendidikan" class="form-label">Nama pendidikan</label>
                        <input type="name" class="form-control" id="nama_pendidikan" aria-describedby="nama_pendidikan" value="{{ old('nama_pendidikan') }}" name="nama_pendidikan">
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