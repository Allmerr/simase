@extends('adminlte::page')

@section('title', 'SIMASE | Data Sertifikat')

@section('content_header')
    <h1 class="m-0">Data Sertifikat</h1>
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
                                <th>Nomor Blanko</th>
                                <th>Skema</th>
                                <th>Masa Berlaku</th>
                                <th>File Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($status_pesertas->count() != 0)

                            @foreach($status_pesertas as $key => $status_peserta)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $status_peserta->nomor_blanko }}</td>
                                <td>{{ $status_peserta->skema->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($status_peserta->tanggal_expired)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ asset('/storage/file_sertifikat/' . $status_peserta->file_sertifikat) }}" class="btn btn-primary btn-xs" target="_blank"><i class="fas fa-download"></i></a>
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
@stop

@push('js')
<script>
$('#example2').DataTable({
    "responsive": true,
});
</script>
@endpush

