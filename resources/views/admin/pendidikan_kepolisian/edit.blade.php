@extends('adminlte::page')

@section('title', 'SIMASE | Edit Pendidikan Kepolisian')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Pendidikan Kepolisian</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pendidikan-kepolisian.update', $pendidikan_kepolisian->id_pendidikan_kepolisian) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Satuan Kerja</label>
                        <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ old('nama', $pendidikan_kepolisian->nama) }}" name="nama" required>
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

