@extends('adminlte::page')

@section('title', 'SIMASE | Create Kota/Kabupaten')

@section('content_header')
    <h1 class="m-0 text-dark">Create Kota/Kabupaten</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kota-kabupaten.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="kode_provinsi" class="form-label">Kode Provinsi</label>
                        <select class="form-select @error('kode_provinsi') is-invalid @enderror" name="kode_provinsi"  required>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->kode_provinsi }}" @if($provinsi->kode_provinsi === old('kode_provinsi')) selected @endif>{{ $provinsi->kode_provinsi }} - {{ $provinsi->nama_provinsi }}</option>
                            @endforeach
                        </select>
                        @error('kode_provinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_kota_kabupaten" class="form-label">Nama Kota/Kabupaten</label>
                        <input type="name" class="form-control" id="nama_kota_kabupaten" aria-describedby="nama_kota_kabupaten" value="{{ old('nama_kota_kabupaten') }}" name="nama_kota_kabupaten" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_kota_kabupaten" class="form-label">Kode Kota/Kabupaten</label>
                        <input type="name" class="form-control" id="kode_kota_kabupaten" aria-describedby="kode_kota_kabupaten" value="{{ old('kode_kota_kabupaten') }}" name="kode_kota_kabupaten" required>
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
