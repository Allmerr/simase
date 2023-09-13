@extends('adminlte::page')

@section('title', 'SI-MASE | Dashboard')

@section('content_header')
    <h1 class="m-0">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <h3>{{ $jumlah_pendaftar }}</h3>
                                    <p>Pendaftar</p>
                                </div>
                                <div class="icon"><i class="fas fa-user"></i></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3>{{ $peserta_aktif }}</h3>
                                    <p>Peserta Aktif</p>
                                </div>
                                <div class="icon"><i class="fas fa-user-check"></i></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <h3>{{ $peserta_lulus }}</h3>
                                    <p>Peserta Lulus</p>
                                </div>
                                <div class="icon"><i class="fas fa-certificate"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    {{-- <a href="{{ route('pengajuan.create') }}" class="btn btn-primary mb-2">Tambah</a> --}}
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Peserta</th>
                                                    <th>Satuan Kerja</th>
                                                    <th>Nama Skema</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pengajuans as $key => $pengajuan)
                                                @if($pengajuan->is_disetujui === 'pending' || $pengajuan->is_disetujui === 'revisi'  || $pengajuan->is_disetujui === 'menunggu_pending' )
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$pengajuan->user->nama_lengkap}}</td>
                                                    <td>{{$pengajuan->user->satker->nama}}</td>
                                                    <td>{{$pengajuan->skema->nama }}</td>
                                                    @if($pengajuan->is_disetujui == 'menunggu_pending' )
                                                    <td><b> Menunggu Diprosses </b></td>
                                                    @elseif($pengajuan->is_disetujui == 'pending')
                                                    <td><b> Prosses Pengecekan </b></td>
                                                    @elseif($pengajuan->is_disetujui == 'revisi' )
                                                    <td><b> Revisi </b></td>
                                                    @elseif($pengajuan->is_disetujui == 'disetujui')
                                                    <td><b> Disetujui </b></td>
                                                    @elseif($pengajuan->is_disetujui == 'tidak_disetujui' )
                                                    <td><b> Ditolak </b></td>
                                                    @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
