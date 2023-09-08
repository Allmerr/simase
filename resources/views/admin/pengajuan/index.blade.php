@extends('adminlte::page')

@section('title', 'SIMASE | Data Pengajuan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Pengajuan</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peserta</th>
                                    <th>Nama Skema</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengajuans as $key => $pengajuan)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$pengajuan->user->nama_lengkap}}</td>
                                    <td>{{$pengajuan->skema->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y') }}</td>
                                    <td>{{ $pengajuan->jenis_pengajuan }}</td>
                                    <td>{{$pengajuan->is_disetujui}}</td>
                                    <td>
                                        <a href="{{ route('pengajuan.show', $pengajuan->id_pengajuan) }}" class="badge btn-primary"><i class="far fa-file-alt"></i> Check dan Berikan Persetujuan</a>
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
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
$('#example2').DataTable({
    "responsive": true,
});

</script>
@endpush

