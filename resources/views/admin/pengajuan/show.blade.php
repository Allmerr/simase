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
                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_ktp'))
                                <tr>
                                    <td>KTP</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_ktp) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_ktp" name="file_syarat_ktp"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_ktp" name="file_syarat_ktp"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_ktp" name="file_syarat_ktp" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_kk'))
                                <tr>
                                    <td>KK</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_kk) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_kk" name="file_syarat_kk"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_kk" name="file_syarat_kk"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_kk" name="file_syarat_kk" checked></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_npwp'))
                                <tr>
                                    <td>NPWP</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_npwp) }}">Lihat File</a></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada disetujui" id="file_syarat_npwp" name="file_syarat_npwp"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="ada tidak disetujui" id="file_syarat_npwp" name="file_syarat_npwp"></td>
                                    <td><input class="form-check-input ml-1" type="radio" value="tidak ada" id="file_syarat_npwp" name="file_syarat_npwp" checked></td>
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
