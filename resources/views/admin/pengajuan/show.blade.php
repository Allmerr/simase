@extends('adminlte::page')

@section('title', 'SI-MASE | Form Terima Pengajuan')

@section('content_header')
    <h4 class="m-0">Form Terima Pengajuan '{{ $pengajuan->user->nama_lengkap }}' pada Skema '{{ $pengajuan->skema->nama }}'</h4>
    <style>
        a input{
            cursor: pointer;
        }
    </style>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pengajuan.saveRevisi', $pengajuan->id_pengajuan) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Skema : <a href="#">{{ $pengajuan->skema->nama }}</a></label>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Peserta : <a href="#">{{ $pengajuan->user->nama_lengkap }}</a></label>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Satuan Kerja : {{ $pengajuan->user->satker->nama }}</label>
                    </div>
                    <div class="mb-3">
                        <label for="id_tuk" class="form-label">Tempat Uji Kompetensi (TUK) : {{ $pengajuan->tuk->nama }}</label>
                    </div>
                    <div class="mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td rowspan="2"><b> Peryaratan </b></td>
                                    <td rowspan="2"><b> Unduh </b></td>
                                    <td colspan="2"><b> ADA </b></td>
                                    <td rowspan="2"><b> Tidak ADA </b></td>
                                </tr>
                                <tr>
                                    <td><b> Memenuhi </b></td>
                                    <td><b> Tidak Memenuhi </b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_ijazah_terakhir'))
                                <tr>
                                    <td>Ijazah Terakhir</td>
                                    <p>Status Ijazah Terakhir Sebelumnya: <b>{{ $pengajuan->status_file_syarat_ijazah_terakhir }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_ijazah_terakhir) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sertifikat_pelatihan'))
                                <tr>
                                    <td>Sertifikat Pelatihan</td>
                                    <p>Status Sertifikat Pelatihan Sebelumnya: <b>{{ $pengajuan->status_file_syarat_sertifikat_pelatihan }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sertifikat_pelatihan) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sk_penempatan'))
                                <tr>
                                    <td>SK Penempatan</td>
                                    <p>Status SK Penempatan Sebelumnya: <b>{{ $pengajuan->status_file_syarat_sk_penempatan }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_penempatan) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sk_bebas_narkoba'))
                                <tr>
                                    <td>SK Bebas Narkoba</td>
                                    <p>Status SK Bebas Narkoba Sebelumnya: <b>{{ $pengajuan->status_file_syarat_sk_bebas_narkoba }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_bebas_narkoba) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sk_sehat'))
                                <tr>
                                    <td>SK Sehat</td>
                                    <p>Status SK Sehat Narkoba Sebelumnya: <b>{{ $pengajuan->status_file_syarat_sk_sehat }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_sehat) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_surat_rekomendasi_satker'))
                                <tr>
                                    <td>Surat Rekomendasi Satker</td>
                                    <p>Status Surat Rekomendasi Satker Sebelumnya: <b>{{ $pengajuan->status_file_syarat_surat_rekomendasi_satker }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_surat_rekomendasi_satker) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_nilai_e_rohani'))
                                <tr>
                                    <td>Nilai E Rohani</td>
                                    <p>Status Nilai E Rohani Sebelumnya: <b>{{ $pengajuan->status_file_syarat_nilai_e_rohani }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_nilai_e_rohani) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_smk_skp_terakhir'))
                                <tr>
                                    <td>SMK SKP Terakhir</td>
                                    <p>Status SMK SKP Terakhir Sebelumnya: <b>{{ $pengajuan->status_file_syarat_smk_skp_terakhir }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_smk_skp_terakhir) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_smk_skp_terakhir" name="file_syarat_smk_skp_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_smk_skp_terakhir" name="file_syarat_smk_skp_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_smk_skp_terakhir" name="file_syarat_smk_skp_terakhir" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_cv'))
                                <tr>
                                    <td>DRH (Daftar Riwayat Hidup)</td>
                                    <p>Status DRH (Daftar Riwayat Hidup) Sebelumnya: <b>{{ $pengajuan->status_file_syarat_cv }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_cv) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_cv" name="file_syarat_cv"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_cv" name="file_syarat_cv"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_cv" name="file_syarat_cv" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_pas_photo'))
                                <tr>
                                    <td>Pas Photo</td>
                                    <p>Status Pas Photo Sebelumnya: <b>{{ $pengajuan->status_file_syarat_pas_photo }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_pas_photo) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_pas_photo" name="file_syarat_pas_photo"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_pas_photo" name="file_syarat_pas_photo"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_pas_photo" name="file_syarat_pas_photo" checked></td>
                                </tr>
                                @endif


                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sertifikat_keahlian_khusus'))
                                @if($pengajuan->file_syarat_sertifikat_keahlian_khusus != null)
                                <tr>
                                    <td>Sertifikat Keahlian Khusus</td>
                                    <p>Status Sertifikat Keahlian Khusus Sebelumnya: <b>{{ $pengajuan->status_file_syarat_sertifikat_keahlian_khusus }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sertifikat_keahlian_khusus) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sertifikat_keahlian_khusus" name="file_syarat_sertifikat_keahlian_khusus"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sertifikat_keahlian_khusus" name="file_syarat_sertifikat_keahlian_khusus"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sertifikat_keahlian_khusus" name="file_syarat_sertifikat_keahlian_khusus" checked></td>
                                </tr>
                                @endif
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_nilai_smk'))
                                <tr>
                                    <td>Nilai SMK/SKP</td>
                                    <p>Status Nilai SMK/SKP Sebelumnya: <b>{{ $pengajuan->status_file_syarat_nilai_smk }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_nilai_smk) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_nilai_smk" name="file_syarat_nilai_smk"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_nilai_smk" name="file_syarat_nilai_smk"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_nilai_smk" name="file_syarat_nilai_smk" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_keputusan_penyidik'))
                                <tr>
                                    <td>Keputusan Penyidik</td>
                                    <p>Status Keputusan Penyidik Sebelumnya: <b>{{ $pengajuan->status_file_syarat_keputusan_penyidik }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_keputusan_penyidik) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_keputusan_penyidik" name="file_syarat_keputusan_penyidik"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_keputusan_penyidik" name="file_syarat_keputusan_penyidik"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_keputusan_penyidik" name="file_syarat_keputusan_penyidik" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_skhp'))
                                <tr>
                                    <td>SKHP</td>
                                    <p>Status SKHP Sebelumnya: <b>{{ $pengajuan->status_file_syarat_skhp }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_skhp) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_skhp" name="file_syarat_skhp"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_skhp" name="file_syarat_skhp"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_skhp" name="file_syarat_skhp" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_dokumen_lainnya'))
                                @if($pengajuan->file_syarat_dokumen_lainnya != null)
                                <tr>
                                    <td>Dokumen Lainnya</td>
                                    <p>Status Dokumen Lainnya Sebelumnya: <b>{{ $pengajuan->status_file_syarat_dokumen_lainnya }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_dokumen_lainnya) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_dokumen_lainnya" name="file_syarat_dokumen_lainnya"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_dokumen_lainnya" name="file_syarat_dokumen_lainnya"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_dokumen_lainnya" name="file_syarat_dokumen_lainnya" checked></td>
                                </tr>
                                @endif
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sk_pangkat'))
                                @if($pengajuan->file_syarat_sk_pangkat != null)
                                <tr>
                                    <td>SK Pangkat</td>
                                    <p>Status SK Pangkat Sebelumnya: <b>{{ $pengajuan->status_file_syarat_sk_pangkat }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_pangkat) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sk_pangkat" name="file_syarat_sk_pangkat"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sk_pangkat" name="file_syarat_sk_pangkat"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sk_pangkat" name="file_syarat_sk_pangkat" checked></td>
                                </tr>
                                @endif
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_identitas'))
                                @if($pengajuan->file_syarat_identitas != null)
                                <tr>
                                    <td>Identitas (SIM/KTP/KTA)</td>
                                    <p>Status Identitas (SIM/KTP/KTA) Sebelumnya: <b>{{ $pengajuan->status_file_syarat_identitas }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_identitas) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_identitas" name="file_syarat_identitas"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_identitas" name="file_syarat_identitas"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_identitas" name="file_syarat_identitas" checked></td>
                                </tr>
                                @endif
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_dikbangpes'))
                                @if($pengajuan->file_syarat_dikbangpes != null)
                                <tr>
                                    <td>Sertifikat DIKBANGSPES</td>
                                    <p>Status Sertifikat DIKBANGSPES Sebelumnya: <b>{{ $pengajuan->status_file_syarat_dikbangpes }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_dikbangpes) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_dikbangpes" name="file_syarat_dikbangpes"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_dikbangpes" name="file_syarat_dikbangpes"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_dikbangpes" name="file_syarat_dikbangpes" checked></td>
                                </tr>
                                @endif
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_kep_jabatan'))
                                @if($pengajuan->file_syarat_kep_jabatan != null)
                                <tr>
                                    <td>Sertifikat Kep Jabatan</td>
                                    <p>Status Sertifikat Kep Jabatan Sebelumnya: <b>{{ $pengajuan->status_file_syarat_kep_jabatan }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_kep_jabatan) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_kep_jabatan" name="file_syarat_kep_jabatan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_kep_jabatan" name="file_syarat_kep_jabatan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_kep_jabatan" name="file_syarat_kep_jabatan" checked></td>
                                </tr>
                                @endif
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sprin_pelaksanaan_tugas'))
                                @if($pengajuan->file_syarat_sprin_pelaksanaan_tugas != null)
                                <tr>
                                    <td>Sertifikat Sprin Pelaksanaan Tugas</td>
                                    <p>Status Sertifikat Sprin Pelaksanaan Tugas Sebelumnya: <b>{{ $pengajuan->status_file_syarat_sprin_pelaksanaan_tugas }}</b></p>
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sprin_pelaksanaan_tugas) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sprin_pelaksanaan_tugas" name="file_syarat_sprin_pelaksanaan_tugas"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sprin_pelaksanaan_tugas" name="file_syarat_sprin_pelaksanaan_tugas"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sprin_pelaksanaan_tugas" name="file_syarat_sprin_pelaksanaan_tugas" checked></td>
                                </tr>
                                @endif
                                @endif

                                @if(isset($pengajuan->file_syarat_logbook))
                                    <tr>
                                        <td>Logbook</td>
                                        <p>Status Photo 3x4 Sebelumnya: <b>{{ $pengajuan->status_file_syarat_logbook }}</b></p>
                                        <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_logbook) }}">Lihat File</a></td>
                                        <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_logbook" name="file_syarat_logbook"></td>
                                        <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_logbook" name="file_syarat_logbook"></td>
                                        <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_logbook" name="file_syarat_logbook" checked></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Berikan Catatan disini..." id="catatan" style="height: 100px" name="catatan" required>{{ old('catatan', $pengajuan->catatan) }}</textarea>
                            <label for="floatingTextarea2">Catatan</label>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="is_disetujui" class="form-label">Status Persetujuan Pengajuan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="disetujui" id="is_disetujui_disetujui" name="is_disetujui" @if($pengajuan->is_disetujui === 'disetujui') checked @endif required>
                            <label class="form-check-label" for="is_disetujui_disetujui">
                            Disetujui
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="tidak_disetujui" id="is_disetujui_tidak_disetujui" name="is_disetujui" @if($pengajuan->is_disetujui === 'tidak_disetujui') checked @endif required>
                            <label class="form-check-label" for="is_disetujui_tidak_disetujui">
                            Ditolak
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="revisi" id="is_disetujui_revisi" name="is_disetujui" @if($pengajuan->is_disetujui === 'revisi') checked @endif required>
                            <label class="form-check-label" for="is_disetujui_revisi">
                            Revisi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="pending" id="is_disetujui_pending" name="is_disetujui" @if($pengajuan->is_disetujui === 'pending') checked @endif required>
                            <label class="form-check-label" for="is_disetujui_pending">
                            Proses Pengecekan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="menunggu_pending" id="is_disetujui_menunggu_pending" name="is_disetujui" @if($pengajuan->is_disetujui === 'menunggu_pending') checked @endif required>
                            <label class="form-check-label" for="is_disetujui_menunggu_pending">
                            Menunggu diproses
                            </label>
                        </div>
                    </div>
                    @if($pengajuan->is_disetujui == 'disetujui' || $pengajuan->is_disetujui == 'tidak_disetujui')
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <a href="{{ route('pengajuan.index') }}" class="btn btn-warning w-100">Kembali</a>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('pengajuan.index') }}" class="btn btn-warning w-100">Kembali</a>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@stop
