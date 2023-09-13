@extends('adminlte::page')

@section('title', 'SI-MASE | Data Survey')

@section('content_header')
    <h1 class="m-0">Data Survey</h1>
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
                                    <th>Nama Peserta</th>
                                    <th>Tanggal Survey</th>
                                    <th>Skema</th>
                                    <th>Pekerjaan</th>
                                    <th>Instansi Peserta</th>
                                    <th>Hasil Survey</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surveys as $key => $survey)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$survey->user->nama_lengkap}}</td>
                                    <td>{{ \Carbon\Carbon::parse($survey->created_at)->format('d M Y') }}</td>
                                    <td>{{$survey->skema->nama}}</td>
                                    <td>{{$survey->pekerjaan}}</td>
                                    <td>{{$survey->instansi}}</td>
                                    <td>{{$survey->keterangan}}</td>
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

