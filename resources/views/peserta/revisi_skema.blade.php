@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Skema</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
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
                
                <form action="{{ route('peserta.revisiSkema', $pengajuan->id_skema) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center">Revisi {{ $skema->nama }}</h1>

                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <input type="text" class="form-control" value="{{ $pengajuan->catatan }}" disabled>
                    </div>

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_ktp'))
                    <div class="mb-3">
                        <label for="file_syarat_ktp" class="form-label">Dokumen Persyaratan KTP</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_ktp) }}" target="_blank">{{ $pengajuan->file_syarat_ktp }}</a></p>
                        <p>Status Pengajuan KTP : <b>{{ $pengajuan->status_file_syarat_ktp }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_ktp') is-invalid @enderror" id="file_syarat_ktp" value="{{ old('file_syarat_ktp') }}" name="file_syarat_ktp">
                        @error('file_syarat_ktp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_kk'))
                    <div class="mb-3">
                        <label for="file_syarat_kk" class="form-label">Dokumen Persyaratan KK</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_kk) }}" target="_blank">{{ $pengajuan->file_syarat_kk }}</a></p>
                        <p>Status Pengajuan KK : <b>{{ $pengajuan->status_file_syarat_kk }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_kk') is-invalid @enderror" id="file_syarat_kk" value="{{ old('file_syarat_kk') }}" name="file_syarat_kk">
                        @error('file_syarat_kk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_npwp'))
                    <div class="mb-3">
                        <label for="file_syarat_npwp" class="form-label">Dokumen Persyaratan NPWP</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_npwp) }}" target="_blank">{{ $pengajuan->file_syarat_npwp }}</a></p>
                        <p>Status Pengajuan NPWP : <b>{{ $pengajuan->status_file_syarat_npwp }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_npwp') is-invalid @enderror" id="file_syarat_npwp" value="{{ old('file_syarat_npwp') }}" name="file_syarat_npwp">
                        @error('file_syarat_npwp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    
                    <button type="submit" class="btn btn-outline-secondary">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop