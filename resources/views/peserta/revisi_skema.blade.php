@extends('adminlte::page')

@section('title', 'SI-MASE | Revisi Skema')

@section('content_header')
    <h1 class="m-0">Revisi Skema</h1>
    <style>
        p{
            padding: 0;
            margin: 0;
        }
    </style>
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

                    <div class="my-4">
                        <label for="catatan" class="form-label">Catatan</label>
                        <input type="text" class="form-control" value="{{ $pengajuan->catatan }}" disabled>
                    </div>

                    <div class="my-4">
                        <label for="id_tuk" class="form-label">Tempat Uji Kompetensi (TUK)</label>
                        <select class="form-select @error('id_tuk') is-invalid @enderror" name="id_tuk" >
                            @foreach ($tuks as $tuk)
                                <option value="{{ $tuk->id_tuk }}" @if($pengajuan->id_tuk === $tuk->id_tuk || $tuk->id_tuk  === old('tuk')) selected @endif>{{ $tuk->nama }} - {{ $tuk->alamat }}</option>
                            @endforeach
                        </select>
                        @error('id_tuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_ijazah_terakhir'))
                    <div class="my-4">
                        <label for="file_syarat_ijazah_terakhir" class="form-label">Dokumen Persyaratan Ijazah Terakhir</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_ijazah_terakhir) }}" target="_blank">{{ $pengajuan->file_syarat_ijazah_terakhir }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_ijazah_terakhir }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_sertifikat_pelatihan" class="form-label">Dokumen Persyaratan Sertifikat Pelatihan</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sertifikat_pelatihan) }}" target="_blank">{{ $pengajuan->file_syarat_sertifikat_pelatihan }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_sertifikat_pelatihan }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_sk_penempatan" class="form-label">Dokumen Persyaratan SK Penempatan</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_penempatan) }}" target="_blank">{{ $pengajuan->file_syarat_sk_penempatan }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_sk_penempatan }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_sk_bebas_narkoba" class="form-label">Dokumen Persyaratan SK Bebas Narkoba</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_bebas_narkoba) }}" target="_blank">{{ $pengajuan->file_syarat_sk_bebas_narkoba }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_sk_bebas_narkoba }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_sk_sehat" class="form-label">Dokumen Persyaratan SK Sehat</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_sehat) }}" target="_blank">{{ $pengajuan->file_syarat_sk_sehat }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_sk_sehat }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_surat_rekomendasi_satker" class="form-label">Dokumen Surat Rekomendasi Satker</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_surat_rekomendasi_satker) }}" target="_blank">{{ $pengajuan->file_syarat_surat_rekomendasi_satker }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_surat_rekomendasi_satker }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_nilai_e_rohani" class="form-label">Dokumen Persyaratan Nilai E Rohani</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_nilai_e_rohani) }}" target="_blank">{{ $pengajuan->file_syarat_nilai_e_rohani }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_nilai_e_rohani }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_smk_skp_terakhir" class="form-label">Dokumen Persyaratan SMK SKP Terakhir</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_smk_skp_terakhir) }}" target="_blank">{{ $pengajuan->file_syarat_smk_skp_terakhir }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_smk_skp_terakhir }}</b></p>
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
                    <div class="my-4">
                        <label for="file_syarat_cv" class="form-label">Dokumen Persyaratan CV</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_cv) }}" target="_blank">{{ $pengajuan->file_syarat_cv }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_cv }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_cv') is-invalid @enderror" id="file_syarat_cv" value="{{ old('file_syarat_cv') }}" name="file_syarat_cv" @if($pengajuan->status_file_syarat_cv === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_cv != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_cv')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_pas_photo'))
                    <div class="my-4">
                        <label for="file_syarat_pas_photo" class="form-label">Dokumen Persyaratan Pas Photo</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_pas_photo) }}" target="_blank">{{ $pengajuan->file_syarat_pas_photo }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_pas_photo }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_pas_photo') is-invalid @enderror" id="file_syarat_pas_photo" value="{{ old('file_syarat_pas_photo') }}" name="file_syarat_pas_photo" @if($pengajuan->status_file_syarat_pas_photo === 'ada disetujui')  disabled @endif @if($pengajuan->status_file_syarat_pas_photo != 'ada disetujui') required @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_pas_photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sertifikat_keahlian_khusus'))
                    <div class="my-4">
                        <label for="file_syarat_sertifikat_keahlian_khusus" class="form-label">Dokumen Sertifikat Keahlian Khusus</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sertifikat_keahlian_khusus) }}" target="_blank">{{ $pengajuan->file_syarat_sertifikat_keahlian_khusus }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_sertifikat_keahlian_khusus }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sertifikat_keahlian_khusus') is-invalid @enderror" id="file_syarat_sertifikat_keahlian_khusus" value="{{ old('file_syarat_sertifikat_keahlian_khusus') }}" name="file_syarat_sertifikat_keahlian_khusus" @if($pengajuan->status_file_syarat_sertifikat_keahlian_khusus === 'ada disetujui')  disabled @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sertifikat_keahlian_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_nilai_smk'))
                    <div class="my-4">
                        <label for="file_syarat_nilai_smk" class="form-label">Dokumen Sertifikat Keahlian Khusus</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_nilai_smk) }}" target="_blank">{{ $pengajuan->file_syarat_nilai_smk }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_nilai_smk }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_nilai_smk') is-invalid @enderror" id="file_syarat_nilai_smk" value="{{ old('file_syarat_nilai_smk') }}" name="file_syarat_nilai_smk" @if($pengajuan->status_file_syarat_nilai_smk === 'ada disetujui')  disabled @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sertifikat_keahlian_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_keputusan_penyidik'))
                    <div class="my-4">
                        <label for="file_syarat_keputusan_penyidik" class="form-label">Dokumen Keputusan Penyidik </label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_keputusan_penyidik) }}" target="_blank">{{ $pengajuan->file_syarat_keputusan_penyidik }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_keputusan_penyidik }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_keputusan_penyidik') is-invalid @enderror" id="file_syarat_keputusan_penyidik" value="{{ old('file_syarat_keputusan_penyidik') }}" name="file_syarat_keputusan_penyidik" @if($pengajuan->status_file_syarat_keputusan_penyidik === 'ada disetujui')  disabled @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sertifikat_keahlian_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_skhp'))
                    <div class="my-4">
                        <label for="file_syarat_skhp" class="form-label">Dokumen SKHP</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_skhp) }}" target="_blank">{{ $pengajuan->file_syarat_skhp }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_skhp }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_skhp') is-invalid @enderror" id="file_syarat_skhp" value="{{ old('file_syarat_skhp') }}" name="file_syarat_skhp" @if($pengajuan->status_file_syarat_skhp === 'ada disetujui')  disabled @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sertifikat_keahlian_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_dokumen_lainnya'))
                    <div class="my-4">
                        <label for="file_syarat_dokumen_lainnya" class="form-label">Dokumen Lainnya</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_dokumen_lainnya) }}" target="_blank">{{ $pengajuan->file_syarat_dokumen_lainnya }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_dokumen_lainnya }}</b></p>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_dokumen_lainnya') is-invalid @enderror" id="file_syarat_dokumen_lainnya" value="{{ old('file_syarat_dokumen_lainnya') }}" name="file_syarat_dokumen_lainnya" @if($pengajuan->status_file_syarat_dokumen_lainnya === 'ada disetujui')  disabled @endif accept=".jpeg, .jpg, .png, .pdf, .docx">
                        @error('file_syarat_sertifikat_keahlian_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if($pengajuan->file_syarat_logbook)
                    <div class="my-4">
                        <label for="file_syarat_logbook" class="form-label">Dokumen Persyaratan Logbook</label>
                        <p>Previous File: <a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_logbook) }}" target="_blank">{{ $pengajuan->file_syarat_logbook }}</a></p>
                        <p>Status : <b>{{ $pengajuan->status_file_syarat_logbook }}</b></p>
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
