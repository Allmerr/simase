@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <style>
        form .persyaratan-rich-text img{
            height: 100%;
            width: 100%;
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('skema.show', $skema->id_skema) }}">Detail</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{ route('skema.pesertaSkema', $skema->id_skema) }}" >Peserta</a></li>
                </ul>
            </div>
            <div class="card-body">
                <form action="" method="post" >
                    @csrf
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Skema</label>
                        <input type="name" class="form-control" id="kode" aria-describedby="kode" value="{{ old('kode', $skema->kode) }}" name="kode" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ old('nama', $skema->nama) }}" name="nama" disabled>
                    </div>
                    <div class="mb-3 persyaratan-rich-text">
                        <label for="persyaratan" class="form-label">Persyaratan</label>
                        <br>
                        {!! $skema->persyaratan !!}
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