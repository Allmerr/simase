@extends('adminlte::page')

@section('title', 'SIMASE | Notifikasi Detail')

@section('content_header')
    <h1 class="m-0">Notifikasi Detail</h1>

    <style>

        .main-profile .col-md-3 img{
            width: 100%;
        }

    </style>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <a href="{{ route('peserta.notifikasi') }}" class="btn btn-outline-secondary">Back</a>
                    <h1 class="mt-5">{{ $notifikasi->judul }}</h1>
                    {!! $notifikasi->pesan !!}
                    <br>
                    <br>
                    @if(str_contains($notifikasi->pesan, 'sertifikat'))
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <a href="{{ route('peserta.sertifikat') }}" class="btn btn-primary w-100">Lihat Sertifikat</a>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <a href="{{ route('peserta.statusPengajuan') }}" class="btn btn-primary w-100">Lihat Status Pengajuan</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
