@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
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
                                                    <th>Cek</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pengajuans as $key => $pengajuan)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$pengajuan->user->nama_lengkap}}</td>
                                                    <td>{{$pengajuan->user->satker->nama}}</td>
                                                    <td>{{$pengajuan->skema->nama }}</td>
                                                    <td>{{$pengajuan->is_disetujui}}</td>
                                                    <td>
                                                        <a href="{{ route('pengajuan.show', $pengajuan->id_pengajuan) }}" class="badge btn-primary"><i class="far fa-file-alt"></i> Detail</a>
                                                    </td>
                                                    <td>
                                                        @if ($pengajuan->is_disetujui === 'pending' || $pengajuan->is_disetujui === 'pending_revisi')
                                                            <a href="{{ route('pengajuan.terima', $pengajuan->id_pengajuan) }}" class="badge btn-success"><i class="fas fa-check"></i> Terima</a>
                                                            <a href="{{ route('pengajuan.revisi', $pengajuan->id_pengajuan) }}" class="badge btn-warning"><i class="fas fa-redo"></i> Revisi</a>
                                                            <a href="{{ route('pengajuan.tolak', $pengajuan->id_pengajuan) }}" class="badge btn-danger"><i class="fas fa-times"></i> Tolak</a>
                                                        @else
                                                            <a href="#">Lihat Status Peserta ini</a>
                                                        @endif
                                                        </td> 
                
                                                </tr>
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
