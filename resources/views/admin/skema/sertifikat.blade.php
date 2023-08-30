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
                        <li class="nav-item"><a class="nav-link" href="{{ route('skema.pesertaSkema', $skema->id_skema) }}" >Peserta Aktif</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('skema.sertifikatSkema', $skema->id_skema) }}" >Peserta Lulus</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>File Sertifikat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pengajuans->count() > 0)
                                @foreach ($pengajuans[0]->skema->status_peserta as $key => $pengajuan)
                                    @if($pengajuan->status === 'lulus')
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pengajuan->user->nama_lengkap }}</td>
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
                                            @elseif($pengajuan->status === 'lulus'  && $pengajuan->file_sertifikat === null)
                                            <a href="#" class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $pengajuan->id_users }}">Berikan Sertifikat</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $pengajuan->id_users }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('skema.sertifikatLulus', ['id_skema' => $pengajuan->id_skema, 'id_users' => $pengajuan->user->id_users]) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Kirim File Sertifikat</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nomor_blanko" class="form-label">Nomor Blanko</label>
                                                            <input type="text" class="form-control" id="nomor_blanko" aria-describedby="nomor_blanko" name="nomor_blanko" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nomor_registrasi" class="form-label">Nomor Registrasi</label>
                                                            <input type="text" class="form-control" id="nomor_registrasi" aria-describedby="nomor_registrasi" name="nomor_registrasi" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggal_penetapan" class="form-label">Tanggal Penetapan</label>
                                                            <input type="date" class="form-control" id="tanggal_penetapan" aria-describedby="tanggal_penetapan" name="tanggal_penetapan" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="file_sertifikat" class="form-label">File Sertifikat</label>
                                                            <input type="file" class="form-control" id="file_sertifikat" aria-describedby="file_sertifikat" name="file_sertifikat" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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