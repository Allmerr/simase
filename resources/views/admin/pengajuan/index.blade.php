@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Pengajuan</h1>
@stop

@section('content')

{{-- @dd($skemas) --}}
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
                                        <a href="{{ route('pengajuan.show', $pengajuan->id_pengajuan) }}" class="badge btn-primary"><i class="far fa-file-alt"></i> Check</a>
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

