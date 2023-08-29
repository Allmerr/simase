@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Survey</h1>
@stop

@section('content')

{{-- @dd($skemas) --}}
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
                                    <th>Skema</th>
                                    <th>Instansi Peserta</th>
                                    <th>Sertifikat Sesuai Dengan Skema</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surveys as $key => $survey)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$survey->user->nama_lengkap}}</td>
                                    <td>{{$survey->nomor_blanko}}</td>
                                    <td>{{$survey->skema->nama}}</td>
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
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
$('#example2').DataTable({
    "responsive": true,
});

@if(session()->has('success'))
    Swal.fire({
        title: 'Berhasil Mendaftar!',
        text: '{{  session('success') }}',
        icon: 'success'
    });
@endif
</script>
@endpush

