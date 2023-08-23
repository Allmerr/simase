@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Skema</h1>
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
                                <th>Kode Skema</th>
                                <th>Nama Skema</th>
                                <th>File Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($status_pesertas as $key => $status_peserta)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $status_peserta->skema->kode }}</td>
                                <td>{{ $status_peserta->skema->nama }}</td>
                                <td>
                                    <a href="{{ asset('/storage/file_sertifikat/' . $status_peserta->file_sertifikat) }}">Lihat Sertifikat</a>
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

