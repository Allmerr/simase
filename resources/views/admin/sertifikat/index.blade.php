@extends('adminlte::page')

@section('title', 'SI-MASE | Daftar Sertifikat')

@section('content_header')
    <h1 class="m-0">Daftar Sertifikat</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <a href="{{ route('sertifikat.create') }}" class="btn btn-primary mb-2">Tambah</a>
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Peserta</th>
                                <th>Nomor Blanko</th>
                                <th>Nama Skema</th>
                                <th>Tanggal Penetapan</th>
                                <th>File Sertifikat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($status_pesertas->count() != 0)

                            @foreach($status_pesertas as $key => $status_peserta)
                            @if($status_peserta->file_sertifikat !== null)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $status_peserta->user->nama_lengkap }}</td>
                                <td>{{ $status_peserta->nomor_blanko }}</td>
                                <td>{{ $status_peserta->skema->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($status_peserta->tanggal_penetapan)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ asset('/storage/file_sertifikat/' . $status_peserta->file_sertifikat) }}" class="btn btn-primary btn-xs" target="_blank"><i class="fas fa-download"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('sertifikat.edit', $status_peserta->id_status_peserta) }}" class="btn btn-primary btn-xs edit-button"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('sertifikat.destroy', $status_peserta->id_status_peserta) }}" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

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

