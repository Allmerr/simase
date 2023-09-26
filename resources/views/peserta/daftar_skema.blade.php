@extends('adminlte::page')

@section('title', 'SI-MASE | Daftar Skema')

@section('content_header')
    <h1 class="m-0">Daftar Skema</h1>
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
                <form action="{{ route('peserta.saveDaftarSkema', $skema->id_skema) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center">Pendaftaran Skema : {{ $skema->nama }}</h1>

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_ijazah_terakhir'))
                    <div class="mb-3">
                        <label for="file_syarat_ijazah_terakhir" class="form-label">Dokumen Persyaratan Ijazah Terakhir</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_ijazah_terakhir') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_ijazah_terakhir" value="{{ old('file_syarat_ijazah_terakhir') }}" name="file_syarat_ijazah_terakhir" required>
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
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sertifikat_pelatihan') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_sertifikat_pelatihan" value="{{ old('file_syarat_sertifikat_pelatihan') }}" name="file_syarat_sertifikat_pelatihan" required>
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
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sk_penempatan') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_sk_penempatan" value="{{ old('file_syarat_sk_penempatan') }}" name="file_syarat_sk_penempatan" required>
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
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sk_bebas_narkoba') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_sk_bebas_narkoba" value="{{ old('file_syarat_sk_bebas_narkoba') }}" name="file_syarat_sk_bebas_narkoba" required>
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
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sk_sehat') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_sk_sehat" value="{{ old('file_syarat_sk_sehat') }}" name="file_syarat_sk_sehat" required>
                        @error('file_syarat_sk_sehat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_surat_rekomendasi_satker'))
                    <div class="mb-3">
                        <label for="file_syarat_surat_rekomendasi_satker" class="form-label">Dokumen Persyaratan Surat Rekomendasi Satker</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_surat_rekomendasi_satker') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_surat_rekomendasi_satker" value="{{ old('file_syarat_surat_rekomendasi_satker') }}" name="file_syarat_surat_rekomendasi_satker" required>
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
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_nilai_e_rohani') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_nilai_e_rohani" value="{{ old('file_syarat_nilai_e_rohani') }}" name="file_syarat_nilai_e_rohani" required>
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
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_smk_skp_terakhir') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_smk_skp_terakhir" value="{{ old('file_syarat_smk_skp_terakhir') }}" name="file_syarat_smk_skp_terakhir" required>
                        @error('file_syarat_smk_skp_terakhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_cv'))
                    <div class="mb-3">
                        <label for="file_syarat_cv" class="form-label">Dokumen Persyaratan DRH (Daftar Riwayat Hidup)</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_cv') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_cv" value="{{ old('file_syarat_cv') }}" name="file_syarat_cv" required>
                        @error('file_syarat_cv')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_pas_photo'))
                    <div class="mb-3">
                        <label for="file_syarat_pas_photo" class="form-label">Dokumen Persyaratan Pas Photo</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_pas_photo') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_pas_photo" value="{{ old('file_syarat_pas_photo') }}" name="file_syarat_pas_photo" required>
                        @error('file_syarat_pas_photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sertifikat_keahlian_khusus'))
                    <div class="mb-3">
                        <label for="file_syarat_sertifikat_keahlian_khusus" class="form-label">Dokumen Sertifikat Keahlian Khusus</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sertifikat_keahlian_khusus') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_sertifikat_keahlian_khusus" value="{{ old('file_syarat_sertifikat_keahlian_khusus') }}" name="file_syarat_sertifikat_keahlian_khusus">
                        @error('file_syarat_sertifikat_keahlian_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_nilai_smk'))
                    <div class="mb-3">
                        <label for="file_syarat_nilai_smk" class="form-label">Dokumen Nilai SMK/SKP</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_nilai_smk') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_nilai_smk" value="{{ old('file_syarat_nilai_smk') }}" name="file_syarat_nilai_smk" required>
                        @error('file_syarat_nilai_smk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_keputusan_penyidik'))
                    <div class="mb-3">
                        <label for="file_syarat_keputusan_penyidik" class="form-label">Dokumen Keputusan Penyidik</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_keputusan_penyidik') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_keputusan_penyidik" value="{{ old('file_syarat_keputusan_penyidik') }}" name="file_syarat_keputusan_penyidik" required>
                        @error('file_syarat_keputusan_penyidik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_skhp'))
                    <div class="mb-3">
                        <label for="file_syarat_skhp" class="form-label">Dokumen SKHP</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_skhp') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_skhp" value="{{ old('file_syarat_skhp') }}" name="file_syarat_skhp" required>
                        @error('file_syarat_skhp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_dokumen_lainnya'))
                    <div class="mb-3">
                        <label for="file_syarat_dokumen_lainnya" class="form-label">Dokumen Lainnya</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_dokumen_lainnya') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_dokumen_lainnya" value="{{ old('file_syarat_dokumen_lainnya') }}" name="file_syarat_dokumen_lainnya">
                        @error('file_syarat_dokumen_lainnya')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_sk_pangkat'))
                    <div class="mb-3">
                        <label for="file_syarat_sk_pangkat" class="form-label">SK Pangkat</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_sk_pangkat') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_sk_pangkat" value="{{ old('file_syarat_sk_pangkat') }}" name="file_syarat_sk_pangkat" required>
                        @error('file_syarat_sk_pangkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_identitas'))
                    <div class="mb-3">
                        <label for="file_syarat_identitas" class="form-label">Identitas (SIM/KTP/KTA)</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_identitas') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_identitas" value="{{ old('file_syarat_identitas') }}" name="file_syarat_identitas" required>
                        @error('file_syarat_identitas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_dikbangpes'))
                    <div class="mb-3">
                        <label for="file_syarat_dikbangpes" class="form-label">Sertifikat DIKBANGPES</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_dikbangpes') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_dikbangpes" value="{{ old('file_syarat_dikbangpes') }}" name="file_syarat_dikbangpes" required>
                        @error('file_syarat_dikbangpes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if($skema->status_peserta->where('id_users', Auth::user()->id_users)->first() !== null)
                        @if($skema->status_peserta->where('id_users', Auth::user()->id_users)->first()->status == 'lulus')
                        <div class="mb-3">
                            <label for="file_syarat_logbook" class="form-label">File Logbook</label>
                            <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                            <input type="file" class="form-control @error('file_syarat_logbook') is-invalid @enderror" accept=".jpeg, .jpg, .png, .pdf, .docx," id="file_syarat_logbook" value="{{ old('file_syarat_logbook') }}" name="file_syarat_logbook" required>
                            @error('file_syarat_logbook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif
                    @endif

                    <div class="mb-3">
                        <label for="id_tuk" class="form-label">Tempat Uji Kompetensi (TUK)</label>
                        <select class="form-select @error('id_tuk') is-invalid @enderror" name="id_tuk" >
                            @foreach ($tuks as $tuk)
                                <option value="{{ $tuk->id_tuk }}" @if( $tuk->id_tuk === old('tuk')) selected @endif>{{ $tuk->nama }} - {{ $tuk->alamat }}</option>
                            @endforeach
                        </select>
                        @error('id_tuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('peserta.showSkema') }}" class="btn btn-warning w-100">Kembali</a>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100" onclick="notificationBeforeSubmit(event, this)">Daftar</button>
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
    function notificationBeforeSubmit(event, el) {
        event.preventDefault();

        const skema = "{{ $skema->nama }}";
        Swal.fire({
            title: 'Konfirmasi',
            text: `Apakah anda yakin ingin mendaftar pada ${skema}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi penyimpanan, submit form
                // check all input is filled except file input dengan name file_syarat_keahlian_khusus


                let isFilled = true;
                el.closest('form').querySelectorAll('input').forEach(input => {
                    // except name file_syarat_keahlian_khusus
                    if (input.name == "file_syarat_sertifikat_keahlian_khusus") {
                        return;
                    }
                    if (input.name == "file_syarat_dokumen_lainnya") {
                        return;
                    }
                    if (input.value == "") {
                        isFilled = false;
                    }
                });

                if (!isFilled) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Semua data harus diisi!',
                    })
                    return;
                }

                el.closest('form').submit(); // Menggunakan el.closest() untuk mencari formulir terdekat
            }
        });
    }
</script>
@endpush
