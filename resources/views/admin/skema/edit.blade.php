@extends('adminlte::page')

@section('title', 'SI-MASE | Edit Skema')

@section('content_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
    <h1 class="m-0">Edit Skema</h1>
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
                <form action="{{ route('skema.update', $skema->id_skema) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Skema</label>
                        <input type="name" class="form-control @error('kode') is-invalid @enderror" id="kode" aria-describedby="kode" value="{{ old('kode', $skema->kode) }}" name="kode" required>
                        @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="name" class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nama" value="{{ old('nama', $skema->nama) }}" name="nama" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dokumen_persyaratan" class="form-label">Dokumen Persyaratan</label>
                        <br>
                        <a href="{{ asset('storage/skema/' . $skema->dokumen_persyaratan) }}">Lihat File Sebelumnya</a>
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png .pdf .docx</small>
                        <input class="form-control @error('dokuemen_persyaratn') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" type="file" id="dokumen_persyaratan" name="dokumen_persyaratan">
                        @error('dokuemen_persyaratn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="persyaratan" class="form-label">Persyaratan</label>
                        <input id="x" type="hidden" name="persyaratan" value="{{ $skema->persyaratan }}" required/>
                        <trix-editor input="x" class="trix-content"></trix-editor>
                        @error('persyaratan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Skema photo</label>

                        @if ($skema->photo === 'noskema.png')
                        <img class="img-preview img-fluid mb-3 d-block" src="{{ asset('images/' . $skema->photo) }}">
                        @elseif($skema->photo)
                        <img class="img-preview img-fluid mb-3 d-block" src="{{ asset('storage/skema/' . $skema->photo) }}">
                        @else
                        <img class="img-preview img-fluid mb-3">
                        @endif
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png </small>
                        <input class="form-control @error('photo') is-invalid @enderror" accept=".jpg, .jpeg, .png," type="file"  id="photo" name="photo" onchange="previewphoto()" >
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file_syarat" class="form-label">File Syarat</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_ijazah_terakhir" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_ijazah_terakhir')) checked @endif>
                            <label class="form-check-label" for="file_syarat_ijazah_terakhir">
                                Ijazah Terakhir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sertifikat_keahlian_khusus" id="file_syarat_sertifikat_keahlian_khusus" name="file_syarat_sertifikat_keahlian_khusus" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sertifikat_keahlian_khusus')) checked @endif>
                            <label class="form-check-label" for="file_syarat_sertifikat_keahlian_khusus">
                                Sertifikat Keahlian Khusus
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sertifikat_pelatihan" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sertifikat_pelatihan')) checked @endif>
                            <label class="form-check-label" for="file_syarat_sertifikat_pelatihan">
                                Sertifikat Pelatihan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sk_penempatan" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_penempatan')) checked @endif>
                            <label class="form-check-label" for="file_syarat_sk_penempatan">
                                Sk Penempatan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sk_bebas_narkoba" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_bebas_narkoba')) checked @endif>
                            <label class="form-check-label" for="file_syarat_sk_bebas_narkoba">
                                Sk Bebas Narkoba
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sk_sehat" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_sehat')) checked @endif>
                            <label class="form-check-label" for="file_syarat_sk_sehat">
                                Sk Sehat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_surat_rekomendasi_satker" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_surat_rekomendasi_satker')) checked @endif>
                            <label class="form-check-label" for="file_syarat_surat_rekomendasi_satker">
                                Surat Rekomendasi Satker
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_nilai_e_rohani" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_nilai_e_rohani')) checked @endif>
                            <label class="form-check-label" for="file_syarat_nilai_e_rohani">
                                Nilai E Rohani
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_cv" id="file_syarat_cv" name="file_syarat_cv" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_cv')) checked @endif>
                            <label class="form-check-label" for="file_syarat_cv">
                                DRH (Daftar Riwayat Hidup)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_pas_photo" id="file_syarat_pas_photo" name="file_syarat_pas_photo" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_pas_photo')) checked @endif>
                            <label class="form-check-label" for="file_syarat_pas_photo">
                                Pas Photo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_nilai_smk" id="file_syarat_nilai_smk" name="file_syarat_nilai_smk" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_nilai_smk')) checked @endif>
                            <label class="form-check-label" for="file_syarat_nilai_smk">
                                Nilai SMK/SKP
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_keputusan_penyidik" id="file_syarat_keputusan_penyidik" name="file_syarat_keputusan_penyidik" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_keputusan_penyidik')) checked @endif>
                            <label class="form-check-label" for="file_syarat_keputusan_penyidik">
                                Keputusan Penyidik
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_skhp" id="file_syarat_skhp" name="file_syarat_skhp" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_skhp')) checked @endif>
                            <label class="form-check-label" for="file_syarat_skhp">
                                SKHP
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_dokumen_lainnya" id="file_syarat_dokumen_lainnya" name="file_syarat_dokumen_lainnya" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_dokumen_lainnya')) checked @endif>
                            <label class="form-check-label" for="file_syarat_dokumen_lainnya">
                                Dokumen Lainnya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sk_pangkat" id="file_syarat_sk_pangkat" name="file_syarat_sk_pangkat" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_pangkat')) checked @endif>
                            <label class="form-check-label" for="file_syarat_sk_pangkat">
                                SK Pangkat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_identitas" id="file_syarat_identitas" name="file_syarat_identitas" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_identitas')) checked @endif>
                            <label class="form-check-label" for="file_syarat_identitas">
                                Identitas (SIM/KTP/KTA)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_dikbangpes" id="file_syarat_dikbangpes" name="file_syarat_dikbangpes" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_dikbangpes')) checked @endif>
                            <label class="form-check-label" for="file_syarat_dikbangpes">
                                Sertifikat DIKBANGPES
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_kep_jabatan" id="file_syarat_kep_jabatan" name="file_syarat_kep_jabatan" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_kep_jabatan')) checked @endif>
                            <label class="form-check-label" for="file_syarat_kep_jabatan">
                                Kep Jabatan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file_syarat_sprin_pelaksanaan_tugas" id="file_syarat_sprin_pelaksanaan_tugas" name="file_syarat_sprin_pelaksanaan_tugas" @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sprin_pelaksanaan_tugas')) checked @endif>
                            <label class="form-check-label" for="file_syarat_sprin_pelaksanaan_tugas">
                                Sprin Pelaksanaan Tugas
                            </label>
                        </div>
                        @error('file_syarat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="aktif" id="status_aktif" name="status" @if($skema->status === 'aktif') checked @endif>
                            <label class="form-check-label" for="status_aktif">
                              Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="tidak aktif" id="status_tidak_aktif" name="status" @if($skema->status === 'tidak aktif') checked @endif>
                            <label class="form-check-label" for="status_tidak_aktif">
                              Tidak Aktif
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2 d-flex">
                            <a href="{{ route('skema.index') }}" class="btn btn-danger mr-2">Kembali</a>
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
