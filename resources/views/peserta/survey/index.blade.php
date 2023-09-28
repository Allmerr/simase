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
                                    <th>No Blanko</th>
                                    <th>Skema</th>
                                    <th>Tanggal Penetapan</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surveys as $key => $survey)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$survey->nomor_blanko}}</td>
                                    <td>{{$survey->skema->nama}}</td>
                                    <td>{{ \Carbon\Carbon::parse($survey->tanggal_penetapan)->format('d M Y') }}</td>

                                    @if(isset($survey->survey))
                                    <td>{{ $survey->survey['keterangan'] }}</td>
                                    @else
                                    <td></td>
                                    @endif


                                    @if($survey->sudah_servey === 'belum')
                                    <td>
                                        <a href="{{ route('peserta.survey.create', $survey->id_status_peserta) }}" class="btn btn-primary btn-xs edit-button"><i class="fa fa-edit"> Isi Survey</i></a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{ route('peserta.daftarSkema', $survey->id_skema) }}" class="btn btn-warning btn-xs edit-button"> Perpanjang</i></a>
                                    </td>
                                    @endif

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

