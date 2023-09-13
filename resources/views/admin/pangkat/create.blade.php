@extends('adminlte::page')

@section('title', 'SI-MASE | Tambah Pangkat')

@section('content_header')
    <h1 class="m-0">Tambah Pangkat</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pangkat.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Pangkat</label>
                        <input type="name" class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nama" value="{{ old('nama') }}" name="nama" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('pangkat.index') }}" class="btn btn-warning w-100">Kembali</a>
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
