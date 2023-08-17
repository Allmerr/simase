@extends('peserta.layouts.main')
@section('content')
    <div class="container">
        <a href="{{ route('peserta.notifikasi') }}" class="btn btn-outline-secondary">Back</a>
        <h1 class="mt-5">{{ $notifikasi->judul }}</h1>
        {!! $notifikasi->pesan !!}
    </div>
@endsection