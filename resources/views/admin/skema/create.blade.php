@extends('adminlte::page')

@section('title', 'SI-MASE | Tambah Skema')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
    <h1 class="m-0">Tambah Skema</h1>
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
                        <input type="name" class="form-control @error('kode') is-invalid @enderror" id="kode" aria-describedby="kode" value="{{ old('kode') }}" name="kode" required>
                        @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="name" class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nama" value="{{ old('nama') }}" name="nama" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="persyaratan" class="form-label">Persyaratan</label>
                        <input id="x" type="hidden" name="persyaratan" value="" required/>
                        <trix-editor input="x" class="trix-content"></trix-editor>
                    </div>
                    <div class="mb-3">
                        <label for="dokumen_persyaratan" class="form-label">Dokumen SK Skema</label>
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png .pdf .docx</small>
                        <input class="form-control @error('dokuemen_persyaratn') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" type="file" id="dokumen_persyaratan" name="dokumen_persyaratan" required>
                        @error('dokumen_persyaratan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Skema photo</label>

                        <img class="img-preview img-fluid mb-3">
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png </small>
                        <input class="form-control @error('photo') is-invalid @enderror" accept=".jpg, .jpeg, .png" type="file"  id="photo" name="photo" onchange="previewphoto()" required>
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file_syarat" class="form-label">File Syarat</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_ijazah_terakhir" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir">
                            <label class="form-check-label" for="file_syarat_ijazah_terakhir">
                                Ijazah Terakhir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sertifikat_keahlian_khusus" id="file_syarat_sertifikat_keahlian_khusus" name="file_syarat_sertifikat_keahlian_khusus">
                            <label class="form-check-label" for="file_syarat_sertifikat_keahlian_khusus">
                                Sertifikat Keahlian Khusus
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sertifikat_pelatihan" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan">
                            <label class="form-check-label" for="file_syarat_sertifikat_pelatihan">
                                Sertifikat Pelatihan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sk_penempatan" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan">
                            <label class="form-check-label" for="file_syarat_sk_penempatan">
                                SK Penempatan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sk_bebas_narkoba" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba">
                            <label class="form-check-label" for="file_syarat_sk_bebas_narkoba">
                                SK Bebas Narkoba
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sk_sehat" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat">
                            <label class="form-check-label" for="file_syarat_sk_sehat">
                                SK Sehat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_surat_rekomendasi_satker" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker">
                            <label class="form-check-label" for="file_syarat_surat_rekomendasi_satker">
                                Surat Rekomendasi Satker
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_nilai_e_rohani" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani">
                            <label class="form-check-label" for="file_syarat_nilai_e_rohani">
                                Nilai E Rohani
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_cv" id="file_syarat_cv" name="file_syarat_cv">
                            <label class="form-check-label" for="file_syarat_cv">
                                CV
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_pas_photo" id="file_syarat_pas_photo" name="file_syarat_pas_photo">
                            <label class="form-check-label" for="file_syarat_pas_photo">
                                Pas Photo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_nilai_smk" id="file_syarat_nilai_smk" name="file_syarat_nilai_smk">
                            <label class="form-check-label" for="file_syarat_nilai_smk">
                                Nilai SMK/SKP
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_keputusan_penyidik" id="file_syarat_keputusan_penyidik" name="file_syarat_keputusan_penyidik">
                            <label class="form-check-label" for="file_syarat_keputusan_penyidik">
                                Keputusan Penyidik
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_skhp" id="file_syarat_skhp" name="file_syarat_skhp">
                            <label class="form-check-label" for="file_syarat_skhp">
                                SKHP
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_dokumen_lainnya" id="file_syarat_dokumen_lainnya" name="file_syarat_dokumen_lainnya">
                            <label class="form-check-label" for="file_syarat_dokumen_lainnya">
                                Dokumen Lainnya
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
                        <div class="col-md-2 d-flex">
                            <a href="{{ route('skema.index') }}" class="btn btn-danger mr-2">Kembali</a>
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
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
