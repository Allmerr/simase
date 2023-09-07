@extends('adminlte::page')

@section('title', 'SIMASE | Create Pekerjaan')

@section('content_header')
    <h1 class="m-0 text-dark">Create Pekerjaan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pekerjaan.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="kode_pekerjaan" class="form-label">Kode Pekerjaan</label>
                        <input type="name" class="form-control" id="kode_pekerjaan" aria-describedby="kode_pekerjaan" value="{{ old('kode_pekerjaan') }}" name="kode_pekerjaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pekerjaan" class="form-label">Nama Pekerjaan</label>
                        <input type="name" class="form-control" id="nama_pekerjaan" aria-describedby="nama_pekerjaan" value="{{ old('nama_pekerjaan') }}" name="nama_pekerjaan" required>
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
