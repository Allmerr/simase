@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
    <h1 class="m-0 text-dark">Create Skema</h1>
@stop

@section('content')
<style>
    form img{
        width: 200px;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('skema.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Skema</label>
                        <input type="name" class="form-control" id="kode" aria-describedby="kode" value="{{ old('kode') }}" name="kode">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ old('nama') }}" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="persyaratan" class="form-label">Persyaratan</label>
                        <input id="x" type="hidden" name="persyaratan" value="" />
                        <trix-editor input="x" class="trix-content"></trix-editor>
                    </div>
                    <div class="mb-3">
                        <label for="dokumen_persyaratan" class="form-label">Dokumen Persyaratan</label>
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png .pdf .docx</small>
                        <input class="form-control @error('dokuemen_persyaratn') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" type="file" id="dokumen_persyaratan" name="dokumen_persyaratan">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Skema photo</label>

                        <img class="img-preview img-fluid mb-3">
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png </small>
                        <input class="form-control @error('photo') is-invalid @enderror" accept=".jpg, .jpeg, .png," type="file"  id="photo" name="photo" onchange="previewphoto()">
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file_syarat" class="form-label">File Syarat</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_ktp" id="file_syarat_ktp" name="file_syarat_ktp">
                            <label class="form-check-label" for="file_syarat_ktp">
                              KTP
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_kk" id="file_syarat_kk" name="file_syarat_kk">
                            <label class="form-check-label" for="file_syarat_kk">
                              KK
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_npwp" id="file_syarat_npwp" name="file_syarat_npwp">
                            <label class="form-check-label" for="file_syarat_npwp">
                              NPWP
                            </label>
                        </div>
                        @error('file_syarat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script src="{{ asset('/js/trix.umd.min.js') }}"></script>
<script src="{{ asset('/js/attachments.js') }}"></script>
<script>
function previewphoto(){
    const photo = document.querySelector('#photo');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(photo.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}  
</script> 
@endpush