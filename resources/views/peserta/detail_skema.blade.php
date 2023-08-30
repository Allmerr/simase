@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Skema</h1>
    <style>
        .blog-content {
            margin: 0 0;
        }

        .blog-content img {
            width: 30%;
            height: 30%;
            object-fit: contain
            margin: 20px 0;
        }

        @media(max-width: 768px) {
            .blog-content img {
                width: 100%;
                height: 100%;
            }
        }
    </style>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="container my-5">
                    <div class="blog-content">

                        @if ($skema->photo == 'noskema.png')
                        <img src="{{ asset('/images/' . $skema->photo) }}" alt="" style="margin-top:-40px;">
                        @else
                        <img src="{{ asset('/storage/skema/' . $skema->photo) }}" alt="" style="margin-top:-40px;">
                        @endif

                        <br>
                        <br>

                        <h4 style="color:#696969">Kode Skema : {{ $skema->kode }}</h4>
                        <h1>{{ $skema->nama }}</h1>

                        <div class="main">
                            {!! $skema->persyaratan !!}
                        </div>

                        <br>
                        @if ($skema->photo == 'noskema.png')
                        <a href="{{ asset('/images/' . $skema->dokumen_persyaratan) }}" class="btn btn-outline-primary" target="_blank"><i class="fas fa-download"></i> Lihat File Persyaratan</a>
                        @else
                        <a href="{{ asset('/storage/skema/' . $skema->dokumen_persyaratan) }}" class="btn btn-outline-primary" target="_blank"><i class="fas fa-download"></i> Lihat File Persyaratan</a>
                        @endif
                        <br>

                        <br>
                        <a href="{{ route('peserta.daftarSkema', $skema->id_skema) }}" class="btn btn-primary">Daftar Skema</a>
                        <br>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop