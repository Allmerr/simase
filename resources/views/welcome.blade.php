@extends('adminlte::welcome')


@section('content_header')
    <h1 class="text-center heading-content"><b>SIMASE</b></h1>
    <h4 class="m-0 text-dark">Daftar Pemegang Sertifikat</h4>
@stop

@section('content')
<div class="nav position-absolute top-0 end-0 pt-2 pr-3">
    <a href="{{ route('register') }}" class="fs-4 pr-3">Register</a>
    <a href="{{ route('login') }}" class="fs-4">Login</a>
</div>
<style>
    .content-wrapper{
        margin-left: auto !important;
        padding: 30px;
    }

    .content-header .heading-content{
        margin-top: 30px;
    }

    @media(max-width: 768px){
        .content-wrapper{
            padding: 0px;
        }


        .content-header .heading-content{
            margin-top: 50px;
        }
    }
</style>
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
                                <th>Nomor Blanko</th>
                                <th>Nama Skema</th>
                                <th>Berlaku Sampai Dengan</th>
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
                                <td>{{ $status_peserta->tanggal_expired }}</td>
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
