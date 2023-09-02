@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h4 class="m-0 text-dark">Form Terima Pengajuan '{{ $pengajuan->user->nama_lengkap }}' pada Skema '{{ $pengajuan->skema->nama }}'</h4>
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
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_ijazah_terakhir) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_ijazah_terakhir" name="file_syarat_ijazah_terakhir" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sertifikat_pelatihan'))
                                <tr>
                                    <td>Sertifikat Pelatihan</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sertifikat_pelatihan) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sertifikat_pelatihan" name="file_syarat_sertifikat_pelatihan" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sk_penempatan'))
                                <tr>
                                    <td>SK Penempatan</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_penempatan) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sk_penempatan" name="file_syarat_sk_penempatan" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sk_bebas_narkoba'))
                                <tr>
                                    <td>SK Bebas Narkoba</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_bebas_narkoba) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sk_bebas_narkoba" name="file_syarat_sk_bebas_narkoba" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_sk_sehat'))
                                <tr>
                                    <td>SK Sehat</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_sk_sehat) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_sk_sehat" name="file_syarat_sk_sehat" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_surat_rekomendasi_satker'))
                                <tr>
                                    <td>Surat Rekomendasi Satker</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_surat_rekomendasi_satker) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_surat_rekomendasi_satker" name="file_syarat_surat_rekomendasi_satker" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_nilai_e_rohani'))
                                <tr>
                                    <td>Nilai E Rohani</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_nilai_e_rohani) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_nilai_e_rohani" name="file_syarat_nilai_e_rohani" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_smk_skp_terakhir'))
                                <tr>
                                    <td>SMK SKP Terakhir</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_smk_skp_terakhir) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_smk_skp_terakhir" name="file_syarat_smk_skp_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_smk_skp_terakhir" name="file_syarat_smk_skp_terakhir"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_smk_skp_terakhir" name="file_syarat_smk_skp_terakhir" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_cv'))
                                <tr>
                                    <td>CV</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_cv) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_cv" name="file_syarat_cv"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_cv" name="file_syarat_cv"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_cv" name="file_syarat_cv" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_photo_3x4'))
                                <tr>
                                    <td>Photo 3x4</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_photo_3x4) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_photo_3x4" name="file_syarat_photo_3x4"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_photo_3x4" name="file_syarat_photo_3x4"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_photo_3x4" name="file_syarat_photo_3x4" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_photo_4x6'))
                                <tr>
                                    <td>Photo 4x6</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_photo_4x6) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_photo_4x6" name="file_syarat_photo_4x6"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_photo_4x6" name="file_syarat_photo_4x6"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_photo_4x6" name="file_syarat_photo_4x6" checked></td>
                                </tr>
                                @endif

                                @if($pengajuan->status_peserta()->exists())
                                @if($pengajuan->status_peserta->where('id_skema', $pengajuan->id_skema)->exists())
                                    <tr>
                                        <td>Logbook</td>                                     
                                        <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_logbook) }}">Lihat File</a></td>
                                        <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_logbook" name="file_syarat_logbook"></td>
                                        <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_logbook" name="file_syarat_logbook"></td>
                                        <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_logbook" name="file_syarat_logbook" checked></td>
                                    </tr>
                                @endif
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
                              Tidak Disetujui
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
                              Pending
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning"><b>Ubah</b></button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
