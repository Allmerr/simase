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
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Skema</label>
                        <input type="name" class="form-control" id="kode" aria-describedby="kode" value="{{  $pengajuan->skema->kode }}" name="kode" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Skema</label>
                        <a href="#">
                            <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->skema->nama }}" name="nama" disabled>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Peserta</label>
                        <a href="#">
                            <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->user->nama_lengkap }}" name="nama" disabled>
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Satuan Kerja</label>
                        <input type="name" class="form-control" id="nama" aria-describedby="nama" value="{{ $pengajuan->user->satker->nama }}" name="nama" disabled>
                    </div>
                    <div class="mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td rowspan="2"><b> Peryaratan </b></td>
                                    <td rowspan="2"><b> Unduh </b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_ktp'))
                                <tr>
                                    <td>KTP</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_ktp) }}">Lihat File</a></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_kk'))
                                <tr>
                                    <td>KK</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_kk) }}">Lihat File</a></td>
                                </tr>
                                @endif

                                @if(str_contains(str_replace(',',' ',$pengajuan->skema->file_syarat), 'file_syarat_npwp'))
                                <tr>
                                    <td>NPWP</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_npwp) }}">Lihat File</a></td>
                                </tr>
                                @endif

                                @if($pengajuan->file_syarat_logbook !== null)
                                <tr>
                                    <td>Logbook</td>                                     
                                    <td><a href="{{ asset('/storage/file_syarat/' . $pengajuan->file_syarat_logbook) }}">Lihat File</a></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
