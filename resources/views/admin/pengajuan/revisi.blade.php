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
                        <label for="kode" class="form-label">Kode Skema</label>
                        <input type="name" class="form-control" id="kode" aria-describedby="kode" value="{{  $pengajuan->skema->kode }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Skema</label>
                        <a href="#">
                            <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->skema->nama }}" disabled>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Peserta</label>
                        <a href="#">
                            <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->user->nama_lengkap }}" disabled>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Satuan Kerja</label>
                        <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->user->satker->nama }}" disabled>
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
                        <label for="catatan" class="form-label">Catatan Revisi</label>
                        <input type="name" class="form-control" id="catatan" aria-describedby="catatan" placeholder="Photo KTP tidak terlihat jelas!" name="catatan" value="{{ old('catatan', $pengajuan->catatan) }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning"><b>Revisi</b></button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
