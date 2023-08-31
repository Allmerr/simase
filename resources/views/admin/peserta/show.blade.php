@extends('adminlte::page')

@section('title', 'Detail User')

@section('content_header')
<style>
    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-label {
        flex: 1;
        margin-right: 10px;
    }

    .form-input {
        flex: 2;
    }

    .form-input.input-group {
        display: flex;
    }

    .form-input.input-group input,
    .form-input.input-group button {
        flex: 2;
    }

    .table-left {
        /* Tambahkan gaya untuk mengatur tata letak tabel menjadi ke kiri */
        float: left;
    }

    body {
        font-family: Arial, sans-serif;
    }

    /* Gaya untuk div yang berisi tabel */
    .table-container {
        float: right;
        width: 65%;
        /* Lebar tabel */
        margin-top: 30px;
    }

    /* Gaya untuk label "Data Tim SEAQIL" */
    .label-title {
        font-size: 18px;
        font-weight: bold;
    }

</style>

<h1 class="m-0 text-dark">Detail Profile</h1>

@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if ($user->photo === 'nopp.png')
                            <img class="profile-user-img img-fluid img-rounded"
                                src="{{ asset( 'images/' . $user->photo)  }}" alt="User profile picture">
                            @else
                            <img class="profile-user-img img-fluid img-rounded"
                                src="{{ asset( 'storage/profile/' . $user->photo)  }}" alt="User profile picture">
                            @endif

                            <h3 class="profile-username text-center">{{ $user->nama_lengkap }}</h3>
                            <p class="text-muted text-center">      
                            @if(isset($user->satker->nama))
                                {{ $user->satker->nama }}
                            @else
                                Data jabatan tidak tersedia
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item "><a class="nav-link active" href="">Data Pribadi</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="data-pribadi">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                        <div class="form-input"> : {{ $user->nama_lengkap }}</div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="form-input"> : {{ $user->email }}</div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="no_telpon" class="form-label">No Telephone</label>
                                        <div class="form-input"> : {{ $user->no_telpon }}</div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <div class="form-input"> : {{ $user->jenis_kelamin }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nip" class="form-label">NIP</label>
                                        <div class="form-input"> : {{ $user->nip }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nik" class="form-label">NIK</label>
                                        <div class="form-input"> : {{ $user->nik }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <div class="form-input"> : {{ $user->jabatan }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <div class="form-input"> : {{ $user->tempat_lahir }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <div class="form-input"> : {{ $user->tanggal_lahir }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <div class="form-input"> : {{ $user->alamat }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="kota" class="form-label">Kota/Kabupaten</label>
                                        @if(isset($user->kota_kabupaten))
                                        <div class="form-input"> : {{ $user->kota_kabupaten->kode_kota_kabupaten }} - {{ $user->kota_kabupaten->nama_kota_kabupaten }}</div>
                                        @else
                                        <div class="form-input"> : </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        @if(isset($user->provinsi))
                                        <div class="form-input"> : {{ $user->provinsi->kode_provinsi }} - {{ $user->provinsi->nama_provinsi }}</div>
                                        @else
                                        <div class="form-input"> : </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                        <div class="form-input"> : {{ $user->pendidikan_terakhir }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="dikbangspes" class="form-label">Pendidikan Pengembangan Spesialis (DIKBANGSPES)</label>
                                        <div class="form-input"> : {{ $user->dikbangspes }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="pelatihan_diikuti" class="form-label">Pelatihan Yang Pernah Diikuti</label>
                                        <div class="form-input"> : {{ $user->pelatihan_diikuti }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterampilan_khusus" class="form-label">Keterampilan Khusus</label>
                                        <div class="form-input"> : {{ $user->keterampilan_khusus }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="satker" class="form-label">Satuan Kerja</label>
                                        <div class="form-input"> : {{ $user->satker ? $user->satker->nama : '' }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="pangkat" class="form-label">Pangkat</label>
                                        <div class="form-input"> : {{ $user->pangkat ? $user->pangkat->nama : '' }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="pendidikan_kepolisian" class="form-label">Pendidikan Kepolisian</label>
                                        <div class="form-input"> : {{ $user->pendidikan_kepolisian ? $user->pendidikan_kepolisian->nama : '' }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="form-label">Skema Yang Pernah Diambail</label>
                                        <div class="form-input"> : {{ $skema_diempuh }}</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.peserta.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
<script>
    function pilih(id, nama_pegawai) {
        // Mengisi nilai input dengan data yang dipilih dari tabel
        document.getElementById('selected_id_users').value = id;
        document.getElementById('pegawai').value = nama_pegawai;
    }

</script>



@endpush
