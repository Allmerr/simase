@extends('adminlte::page')

@section('title', 'Detail Skema')

@section('content_header')
    <style>
        .row img{
            height: 30%;
            width: 30%;
            object-fit: contain;
        }
    </style>
    <h1 class="m-0 text-dark">{{ $skema->nama }}</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('skema.show', $skema->id_skema) }}">Deskripsi</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{ route('skema.pesertaSkema', $skema->id_skema) }}" >Peserta Aktif</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('skema.sertifikatSkema', $skema->id_skema) }}" >Peserta Lulus</a></li>
                </ul>
            </div>
            <div class="card-body">
                <form action="" method="post" >
                    @csrf
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode : {{ $skema->kode }}</label>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama : {{ $skema->nama }}</label>
                    </div>
                    <div class="mb-3">
                        <label for="dokumen_persyaratan" class="form-label">Dokumen Persyaratan</label>
                        <br>
                        <a href="{{ asset('/storage/skema/' . $skema->dokumen_persyaratan) }}">Lihat File</a>
                    </div>
                    <div class="mb-3 persyaratan-rich-text">
                        <label for="persyaratan" class="form-label">Persyaratan</label>
                        <br>
                        {!! $skema->persyaratan !!}
                    </div>
                    <div class="mb-3">
                        <label for="file_syarat" class="form-label">File persyaratan yang dibutuhkan : {{ $skema->file_syarat }}</label>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Skema photo</label>

                        @if ($skema->photo === 'noskema.png')
                        <img class="img-preview img-fluid mb-3 d-block" src="{{ asset('images/' . $skema->photo) }}">
                        @elseif($skema->photo)
                        <img class="img-preview img-fluid mb-3 d-block" src="{{ asset('storage/skema/' . $skema->photo) }}">
                        @else
                        <img class="img-preview img-fluid mb-3">
                        @endif

                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <a href="{{ route('skema.index') }}" class="btn btn-primary w-100">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
