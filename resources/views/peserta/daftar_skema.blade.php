@extends('peserta.layouts.main')
@section('content')

<style>
.daftar-skema{
    margin: 0 20%;
}

@media (max-width: 768px) {
    .daftar-skema {
        margin: 0;
    }
}
</style>

<div class="row d-flex justify-content-center align-items-center daftar-skema border rounded p-2">
    <div class="row-md-8">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session()->has('failed')) 
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <a href="{{ route('peserta.profile') }}">{{ session('failed') }}</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>   
        @endif
        <form action="{{ route('peserta.saveDaftarSkema', $skema->id_skema) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center">{{ $skema->nama }}</h1>
            <div class="mb-3">
                <label for="dokumen_persyaratan" class="form-label">Dokumen Persyaratan</label>
                <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                <input type="file" class="form-control @error('dokumen_persyaratan') is-invalid @enderror" id="dokumen_persyaratan" aria-describedby="dokumen_persyaratan" value="{{ old('dokumen_persyaratan') }}" name="dokumen_persyaratan">
                @error('dokumen_persyaratan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-secondary">Daftar</button>
        </form>
    </div>
</div>   

@endsection