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

                    <div class="mb-3">
                        <label for="id_tuk" class="form-label">Tempat Uji Kompetensi (TUK)</label>
                        <select class="form-select @error('id_tuk') is-invalid @enderror" name="id_tuk" >
                            @foreach ($tuks as $tuk)
                                <option value="{{ $tuk->id_tuk }}" @if($tuk->id_tuk === old('tuk')) selected @endif>{{ $tuk->nama }} - {{ $tuk->alamat }}</option>
                            @endforeach
                        </select>
                        @error('id_tuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_ijazah_terakhir'))
                    <div class="mb-3">
                        <label for="file_syarat_ijazah_terakhir" class="form-label">Dokumen Persyaratan Ijazah Terakhir</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_ijazah_terakhir) }}" target="_blank">{{ $pengajuan->file_syarat_ijazah_terakhir }}</a></p>
                        <p>Status Pengajuan Ijazah Terakhir : <b>{{ $pengajuan->status_file_syarat_ijazah_terakhir }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_ijazah_terakhir') is-invalid @enderror" id="file_syarat_ijazah_terakhir" value="{{ old('file_syarat_ijazah_terakhir') }}" name="file_syarat_ijazah_terakhir" @if($pengajuan->status_file_syarat_ijazah_terakhir === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_ijazah_terakhir != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_ijazah_terakhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sertifikat_pelatihan'))
                    <div class="mb-3">
                        <label for="file_syarat_sertifikat_pelatihan" class="form-label">Dokumen Persyaratan Sertifikat Pelatihan</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sertifikat_pelatihan) }}" target="_blank">{{ $pengajuan->file_syarat_sertifikat_pelatihan }}</a></p>
                        <p>Status Pengajuan Sertifikat Pelatihan : <b>{{ $pengajuan->status_file_syarat_sertifikat_pelatihan }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sertifikat_pelatihan') is-invalid @enderror" id="file_syarat_sertifikat_pelatihan" value="{{ old('file_syarat_sertifikat_pelatihan') }}" name="file_syarat_sertifikat_pelatihan" @if($pengajuan->status_file_syarat_sertifikat_pelatihan === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_sertifikat_pelatihan != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sertifikat_pelatihan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_penempatan'))
                    <div class="mb-3">
                        <label for="file_syarat_sk_penempatan" class="form-label">Dokumen Persyaratan SK Penempatan</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_penempatan) }}" target="_blank">{{ $pengajuan->file_syarat_sk_penempatan }}</a></p>
                        <p>Status Pengajuan SK Penempatan : <b>{{ $pengajuan->status_file_syarat_sk_penempatan }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sk_penempatan') is-invalid @enderror" id="file_syarat_sk_penempatan" value="{{ old('file_syarat_sk_penempatan') }}" name="file_syarat_sk_penempatan" @if($pengajuan->status_file_syarat_sk_penempatan === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_sk_penempatan != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sk_penempatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_bebas_narkoba'))
                    <div class="mb-3">
                        <label for="file_syarat_sk_bebas_narkoba" class="form-label">Dokumen Persyaratan SK Bebas Narkoba</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_bebas_narkoba) }}" target="_blank">{{ $pengajuan->file_syarat_sk_bebas_narkoba }}</a></p>
                        <p>Status Pengajuan SK Bebas Narkoba : <b>{{ $pengajuan->status_file_syarat_sk_bebas_narkoba }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sk_bebas_narkoba') is-invalid @enderror" id="file_syarat_sk_bebas_narkoba" value="{{ old('file_syarat_sk_bebas_narkoba') }}" name="file_syarat_sk_bebas_narkoba" @if($pengajuan->status_file_syarat_sk_bebas_narkoba === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_sk_bebas_narkoba != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sk_bebas_narkoba')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_sehat'))
                    <div class="mb-3">
                        <label for="file_syarat_sk_sehat" class="form-label">Dokumen Persyaratan SK Sehat</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_sehat) }}" target="_blank">{{ $pengajuan->file_syarat_sk_sehat }}</a></p>
                        <p>Status Pengajuan SK Sehat : <b>{{ $pengajuan->status_file_syarat_sk_sehat }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sk_sehat') is-invalid @enderror" id="file_syarat_sk_sehat" value="{{ old('file_syarat_sk_sehat') }}" name="file_syarat_sk_sehat" @if($pengajuan->status_file_syarat_sk_sehat === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_sk_sehat != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sk_sehat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_surat_rekomendasi_satker'))
                    <div class="mb-3">
                        <label for="file_syarat_surat_rekomendasi_satker" class="form-label">Dokumen Surat Rekomendasi Satker</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_surat_rekomendasi_satker) }}" target="_blank">{{ $pengajuan->file_syarat_surat_rekomendasi_satker }}</a></p>
                        <p>Status Pengajuan Surat Rekomendasi Satker : <b>{{ $pengajuan->status_file_syarat_surat_rekomendasi_satker }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_surat_rekomendasi_satker') is-invalid @enderror" id="file_syarat_surat_rekomendasi_satker" value="{{ old('file_syarat_surat_rekomendasi_satker') }}" name="file_syarat_surat_rekomendasi_satker" @if($pengajuan->status_file_syarat_surat_rekomendasi_satker === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_surat_rekomendasi_satker != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_surat_rekomendasi_satker')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_nilai_e_rohani'))
                    <div class="mb-3">
                        <label for="file_syarat_nilai_e_rohani" class="form-label">Dokumen Persyaratan Nilai E Rohani</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_nilai_e_rohani) }}" target="_blank">{{ $pengajuan->file_syarat_nilai_e_rohani }}</a></p>
                        <p>Status Pengajuan Nilai E Rohani : <b>{{ $pengajuan->status_file_syarat_nilai_e_rohani }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_nilai_e_rohani') is-invalid @enderror" id="file_syarat_nilai_e_rohani" value="{{ old('file_syarat_nilai_e_rohani') }}" name="file_syarat_nilai_e_rohani" @if($pengajuan->status_file_syarat_nilai_e_rohani === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_nilai_e_rohani != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_nilai_e_rohani')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_smk_skp_terakhir'))
                    <div class="mb-3">
                        <label for="file_syarat_smk_skp_terakhir" class="form-label">Dokumen Persyaratan SMK SKP Terakhir</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_smk_skp_terakhir) }}" target="_blank">{{ $pengajuan->file_syarat_smk_skp_terakhir }}</a></p>
                        <p>Status Pengajuan SMK SKP Terakhir : <b>{{ $pengajuan->status_file_syarat_smk_skp_terakhir }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_smk_skp_terakhir') is-invalid @enderror" id="file_syarat_smk_skp_terakhir" value="{{ old('file_syarat_smk_skp_terakhir') }}" name="file_syarat_smk_skp_terakhir" @if($pengajuan->status_file_syarat_smk_skp_terakhir === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_smk_skp_terakhir != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_smk_skp_terakhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_cv'))
                    <div class="mb-3">
                        <label for="file_syarat_cv" class="form-label">Dokumen Persyaratan CV</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_cv) }}" target="_blank">{{ $pengajuan->file_syarat_cv }}</a></p>
                        <p>Status Pengajuan CV : <b>{{ $pengajuan->status_file_syarat_cv }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_cv') is-invalid @enderror" id="file_syarat_cv" value="{{ old('file_syarat_cv') }}" name="file_syarat_cv" @if($pengajuan->status_file_syarat_cv === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_cv != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_cv')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_photo_3x4'))
                    <div class="mb-3">
                        <label for="file_syarat_photo_3x4" class="form-label">Dokumen Persyaratan Photo 3x4</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_photo_3x4) }}" target="_blank">{{ $pengajuan->file_syarat_photo_3x4 }}</a></p>
                        <p>Status Pengajuan Photo 3x4 : <b>{{ $pengajuan->status_file_syarat_photo_3x4 }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_photo_3x4') is-invalid @enderror" id="file_syarat_photo_3x4" value="{{ old('file_syarat_photo_3x4') }}" name="file_syarat_photo_3x4" @if($pengajuan->status_file_syarat_photo_3x4 === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_photo_3x4 != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_photo_3x4')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_photo_4x6'))
                    <div class="mb-3">
                        <label for="file_syarat_photo_4x6" class="form-label">Dokumen Persyaratan Photo 4x6</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_photo_4x6) }}" target="_blank">{{ $pengajuan->file_syarat_photo_4x6 }}</a></p>
                        <p>Status Pengajuan Photo 4x6 : <b>{{ $pengajuan->status_file_syarat_photo_4x6 }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_photo_4x6') is-invalid @enderror" id="file_syarat_photo_4x6" value="{{ old('file_syarat_photo_4x6') }}" name="file_syarat_photo_4x6" @if($pengajuan->status_file_syarat_photo_4x6 === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_photo_4x6 != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_photo_4x6')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif


                    @if($pengajuan->file_syarat_logbook)
                    <div class="mb-3">
                        <label for="file_syarat_logbook" class="form-label">Dokumen Persyaratan Logbook</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_logbook) }}" target="_blank">{{ $pengajuan->file_syarat_logbook }}</a></p>
                        <p>Status Pengajuan Logbook : <b>{{ $pengajuan->status_file_syarat_logbook }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_logbook') is-invalid @enderror" id="file_syarat_logbook" value="{{ old('file_syarat_logbook') }}" name="file_syarat_logbook" @if($pengajuan->status_file_syarat_logbook=== 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_logbook != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_logbook')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    <button type="submit" class="btn btn-outline-secondary">Ajukan Revisi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
