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
    </style>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="container my-5">
                    <div class="blog-content">

                        <h6 style="color:#696969">Create at {{ $skema->created_at }}</h6>
                        <h1>{{ $skema->nama }}</h1>
                        <a href="{{ route('peserta.daftarSkema', $skema->id_skema) }}" class="btn btn-outline-secondary">Daftar Skema</a>
                        <br>
                        <br>
                        @if ($skema->photo == 'noskema.png')
                        <img src="{{ asset('/images/' . $skema->photo) }}" alt="">
                        @else
                        <img src="{{ asset('/storage/skema/' . $skema->photo) }}" alt="">
                        @endif
                        <br>
                        <br>
                        <div class="main">
                            {!! $skema->persyaratan !!}
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop