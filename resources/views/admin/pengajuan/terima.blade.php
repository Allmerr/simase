@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h4 class="m-0 text-dark">Form Terima Pengajuan '{{ $pengajuan->user->nama_lengkap }}' pada Skema '{{ $pengajuan->skema->nama }}'</h4>
    <style>
        a input{
            cursor: pointer;
        }
    </style>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Skema</label>
                        <input type="name" class="form-control" id="kode" aria-describedby="kode" value="{{  $pengajuan->skema->kode }}" name="kode" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Skema</label>
                        <a href="#">
                            <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->skema->nama }}" name="nama" disabled>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Peserta</label>
                        <a href="#">
                            <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->user->nama_lengkap }}" name="nama" disabled>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Satuan Kerja</label>
                        <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->user->satker->nama }}" name="nama" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="dokumen_persyaratan">Dokumen Persayaratan</label>
                        <br>
                        <a href="{{ $pengajuan->dokumen_persyaratan }}">Lihat Dokumen</a>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <form action="{{ route('pengajuan.saveTerima', $pengajuan->id_pengajuan) }}" method="POST">
                    <a href="{{ route('pengajuan.index') }}" class="btn btn-danger">Kembali</a>
                    @csrf
                    <button type="submit" class="btn btn-success"><b>Terima</b></button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
