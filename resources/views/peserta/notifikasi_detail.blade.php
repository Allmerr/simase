@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

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
                </div>
            </div>
        </div>
    </div>
</div>
@stop