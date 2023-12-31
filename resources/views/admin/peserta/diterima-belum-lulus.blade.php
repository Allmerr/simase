@extends('adminlte::page')

@section('title', 'SI-MASE | Daftar Calon Peserta')

@section('content_header')
    <h1 class="m-0">Daftar Calon Peserta</h1>
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
                                <option value="all">Semua Skema</option>
                                @foreach ($skemas as $skema)
                                    <option value="{{ $skema->id_skema }}" @if(request()->id_skema == $skema->id_skema) selected @endif>{{ $skema->nama }}</option>
                                @endforeach
                            </select>
                            <select name="id_tuk" id="id_tuk" class="form-select ml-2">
                                <option value="all">Semua tuk</option>
                                @foreach ($tuks as $tuk)
                                    <option value="{{ $tuk->id_tuk }}" @if(request()->id_tuk == $tuk->id_tuk) selected @endif>{{ $tuk->nama }}</option>
                                @endforeach
                            </select>
                            <select name="status" id="status" class="form-select ml-2">
                                <option value="all" @if(request()->status == 'all') selected @endif>Semua Status</option>
                                <option value="perpanjang" @if(request()->status == 'perpanjang') selected @endif>Perpanjang</option>
                                <option value="baru" @if(request()->status == 'baru') selected @endif>Baru</option>
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">Cari</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nama</th>
                                    <th>Pangkat</th>
                                    <th>NRP/NIP</th>
                                    <th>Jabatan</th>
                                    <th>Satker</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>NIK</th>
                                    <th>Alamat Tinggal</th>
                                    <th>Kabupaten + Kode</th>
                                    <th>No Telpon</th>
                                    <th>Email</th>
                                    <th>Pendidikan Umur Terakhir</th>
                                    <th>Jenis Skema Sertifikat Yang Diajukan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($status_pesertas as $key => $status_peserta)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $status_peserta->user->jenis_kelamin }}</td>
                                    <td>{{ $status_peserta->user->nama_lengkap }}</td>
                                    <td>{{ $status_peserta->user->pangkat->nama }}</td>
                                    <td>{{ $status_peserta->user->nip }}</td>
                                    <td>{{ $status_peserta->user->jabatan }}</td>
                                    <td>{{ $status_peserta->user->satker->nama }}</td>
                                    <td>{{ $status_peserta->user->tempat_lahir }}</td>
                                    <td>{{ $status_peserta->user->tanggal_lahir }}</td>
                                    <td>{{ $status_peserta->user->nik }}</td>
                                    <td>{{ $status_peserta->user->alamat }}</td>
                                    <td>{{ $status_peserta->user->kota_kabupaten->nama_kota_kabupaten }} {{ $status_peserta->user->kode_kota_kabupaten }}</td>
                                    <td>{{ $status_peserta->user->no_telpon }}</td>
                                    <td>{{ $status_peserta->user->email }}</td>
                                    <td>{{ $status_peserta->user->pendidikan->nama_pendidikan }}</td>
                                    <td>{{ $status_peserta->skema->nama }}</td>
                                    <td></td>
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
                title: 'Daftar Asesi Diterima Belum Lulus',
            },
            {
                extend: 'print',
                title: 'Daftar Asesi Diterima Belum Lulus',
            },
        ]

    } );
} );
</script>
@endpush

