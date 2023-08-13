@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
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
                        <input type="name" class="form-control" id="persyaratan" aria-describedby="persyaratan" value="{{ old('persyaratan') }}" name="persyaratan">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Skema photo</label>

                        <img class="img-preview img-fluid mb-3">

                        <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" onchange="previewphoto()">
                        @error('photo')
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