@extends('adminlte::page')

@section('title', 'SI-MASE | Lapor Pengajuan BNSP')

@section('content_header')
    <h1 class="m-0">Lapor Pengajuan BNSP</h1>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="#" method="GET">
                        <label for="id_skema">Select a skema</label>
                        <div class="form-group d-flex">
                            <select name="id_skema" id="id_skema" class="form-select">
                                <option value="all">All Skema</option>
                                @foreach ($skemas as $skema)
                                    <option value="{{ $skema->id_skema }}" @if(request()->id_skema == $skema->id_skema) selected @endif>{{ $skema->nama }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">Cari</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Asesi</th>
                                    <th>NIK</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Tinggal</th>
                                    <th>Kode Kota</th>
                                    <th>Kode Provinsi</th>
                                    <th>Nomor Telepon</th>
                                    <th>Email</th>
                                    <th>Kode Pendidikan</th>
                                    <th>Kode Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($status_pesertas as $key => $status_peserta)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $status_peserta->user->nama_lengkap }}</td>
                                    <td>{{ $status_peserta->user->nik }}</td>
                                    <td>{{ $status_peserta->user->tempat_lahir }}</td>
                                    <td>{{ $status_peserta->user->tanggal_lahir }}</td>
                                    <td>{{ $status_peserta->user->jenis_kelamin }}</td>
                                    <td>{{ $status_peserta->user->alamat }}</td>
                                    <td>{{ $status_peserta->user->kode_kota_kabupaten }}</td>
                                    <td>{{ $status_peserta->user->kode_provinsi }}</td>
                                    <td>{{ $status_peserta->user->no_telpon }}</td>
                                    <td>{{ $status_peserta->user->email }}</td>
                                    <th>{{ $status_peserta->user->kode_pekerjaan }}</th>
                                    <th>{{ $status_peserta->user->kode_pendidikan }}</th>
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

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"> </script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


<script>

$(document).ready(function() {
    $('#example2').DataTable( {
        "responsive": true,
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'excel',
                title: 'Daftar Asesi Lulus Belum Bersertifikat',
            },
            {
                extend: 'print',
                title: 'Daftar Asesi Lulus Belum Bersertifikat',
            },
        ]

    } );
} );
</script>
@endpush

