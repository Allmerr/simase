@extends('adminlte::page')

@section('title', 'SI-MASE | Edit TUK')

@section('content_header')
    <h1 class="m-0">Edit Tempat Uji Kompetensi</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tuk.update', $tuk->id_tuk) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Tempat Uji Kompotensi (TUK)</label>
                        <input type="name" class="form-control @error('nama') is-invalid @enderror " id="nama" aria-describedby="nama" value="{{ old('nama', $tuk->nama) }}" name="nama" required>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Tempat Uji Kompotensi (TUK)</label>
                        <input type="name" class="form-control @error('alamat') is-invalid @enderror " id="alamat" aria-describedby="alamat" value="{{ old('alamat', $tuk->alamat) }}" name="alamat" required>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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

