@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Status Pengajuan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Skema</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Jenis Pengajuan</th>
                                <th>Status Pengajuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajuans as $key => $pengajuan)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $pengajuan->skema->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y') }}</td>
                                <td>{{ $pengajuan->jenis_pengajuan }}</td>
                                <td><b>{{ $pengajuan->is_disetujui }}</b></td>
                                <td>
                                    @if($pengajuan->is_disetujui === 'revisi')
                                        <a href="{{ route('peserta.revisiSkema', $pengajuan->id_skema) }}" class="badge bg-warning">Revisi Pengajuan</a>
                                    @elseif($pengajuan->is_disetujui === 'ditolak')
                                        <a href="#" class="badge bg-danger">Daftar Kembali</a>
                                    @endif
                                        <a href="{{ route('peserta.detailSkema', $pengajuan->skema->id_skema) }}" class="badge bg-primary">Detail Skema</a>
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
@stop

@push('js')
<script>
$('#example2').DataTable({
    "responsive": true,
});
</script>
@endpush

