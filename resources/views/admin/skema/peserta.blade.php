@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
   <h1 class="m-0 text-dark">Peserta : {{ $skema->nama }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="{{ route('skema.show', $skema->id_skema) }}">Deskripsi</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('skema.pesertaSkema', $skema->id_skema) }}" >Peserta</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('skema.sertifikatSkema', $skema->id_skema) }}" >Peserta Lulus</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Status</th>
                                    <th>File Sertifikat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pengajuans->count() > 0)
                                @foreach ($pengajuans[0]->skema->status_peserta as $key => $pengajuan)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pengajuan->user->nama_lengkap }}</td>
                                        <td>{{ $pengajuan->status }}</td>
                                        <td>
                                            @if($pengajuan->status !== 'lulus')
                                            <b>Belum Dinyatakan Lulus</b>
                                            @elseif($pengajuan->status === 'lulus'  && $pengajuan->file_sertifikat !== null)
                                            <a href="{{ asset('/storage/file_sertifikat/' . $pengajuan->file_sertifikat) }}">Lihat Sertifikat</a>
                                            @else
                                            <b>Data Sertifikat Belum Diberikan</b>
                                            @endif
                                        </td>
                                        <td>
                                            @if($pengajuan->status !== 'lulus')
                                            <a href="{{ route('skema.pesertaSkemaLulus', ['id_skema' => $pengajuan->id_skema, 'id_users' => $pengajuan->id_users]) }}" class="btn btn-success btn-xs">Lulus</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
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
