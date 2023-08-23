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
                                        <div class="form-input"> : {{ $user->kota }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <div class="form-input"> : {{ $user->provinsi }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                        <div class="form-input"> : {{ $user->pendidikan_terakhir }}</div>
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

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('peserta.index') }}" class="btn btn-default">Kembali</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('peserta.updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="name" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" aria-describedby="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" name="nama_lengkap">
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="no_telpon" class="form-label">No Telephone</label>
                        <input type="name" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" aria-describedby="no_telpon" value="{{ old('no_telpon', $user->no_telpon) }}" name="no_telpon">
                        @error('no_telpon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" >
                            <option value="Laki-Laki" @if($user->jenis_kelamin == 'Laki-Laki' || old('jenis_kelamin')=='Laki-Laki' ) selected @endif>Laki-Laki</option>
                            <option value="Perempuan" @if($user->jenis_kelamin == 'Perempuan' || old('jenis_kelamin')=='Perempuan' ) selected @endif>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nip" class="form-label">Nip</label>
                        <input type="name" class="form-control @error('nip') is-invalid @enderror" id="nip" aria-describedby="nip" value="{{ $user->nip }}" name="nip">
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">nik</label>
                        <input type="name" class="form-control @error('nik') is-invalid @enderror" id="nik" aria-describedby="nik" value="{{ $user->nik }}" name="nik">
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="name" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" aria-describedby="jabatan" value="{{ $user->jabatan }}" name="jabatan">
                        @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="name" class="form-control @error('jabatan') is-invalid @enderror" id="tempat_lahir" aria-describedby="tempat_lahir" value="{{ $user->tempat_lahir }}" name="tempat_lahir">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" aria-describedby="tanggal_lahir" value="{{ $user->tanggal_lahir }}" name="tanggal_lahir">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="name" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="alamat" aria-describedby="alamat" value="{{ $user->alamat }}" name="alamat">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label">Kota/Kabupaten</label>
                        <select class="form-select @error('kota') is-invalid @enderror" name="kota" >
                            <option value="Kota Bogor" @if($user->kota == 'Kota Bogor' || old('kota')=='Kota Bogor' ) selected @endif>Kota Bogor</option>
                            <option value="Kab Kabupaten" @if($user->kota == 'Kab Kabupaten' || old('kota')=='Kab Kabupaten' ) selected @endif>Kab Kabupaten</option>
                        </select>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <select class="form-select" name="provinsi" >
                            <option value="Jawa Barat" @if($user->provinsi == 'Jawa Barat' || old('provinsi')=='Jawa Barat' ) selected @endif>Jawa Barat</option>
                            <option value="DKI Jakarta" @if($user->provinsi == 'DKI Jakarta' || old('provinsi')=='DKI Jakarta' ) selected @endif>DKI Jakarta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select" name="pendidikan_terakhir" >
                            <option value="Sarjana" @if($user->pendidikan_terakhir == 'Sarjana' || old('pendidikan_terakhir')=='Sarjana' ) selected @endif>Sarjana</option>
                            <option value="Magister" @if($user->pendidikan_terakhir == 'Magister' || old('pendidikan_terakhir')=='Magister' ) selected @endif>Magister</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="satker" class="form-label">Satuan Kerja</label>
                        <select class="form-select" name="id_satker" >
                            @foreach ($satkers as $satker)
                                <option value="{{ $satker->id_satker }}" @if(($user->satker ? $user->satker->nama : '') == $satker->nama || old('satker')==$satker->nama ) selected @endif>{{ $satker->nama }}</option>
                            @endforeach
                        </select>
                        @error('satker')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pangkat" class="form-label">Pangkat</label>
                        <select class="form-select" name="id_pangkat" >
                            @foreach ($pangkats as $pangkat)
                                <option value="{{ $pangkat->id_pangkat }}" @if(($user->pangkat ? $user->pangkat->nama : '') == $pangkat->nama || old('pangkat')==$pangkat->nama ) selected @endif>{{ $pangkat->nama }}</option>
                            @endforeach
                        </select>
                        @error('pangkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_kepolisian" class="form-label">Pendidikan Kepolisian</label>
                        <select class="form-select" name="id_pendidikan_kepolisian" >
                            @foreach ($pendidikan_kepolisians as $pendidikan_kepolisian)
                                <option value="{{ $pendidikan_kepolisian->id_pendidikan_kepolisian }}" @if(($user->pendidikan_kepolisian ? $user->pendidikan_kepolisian->nama : '') == $pendidikan_kepolisian->nama || old('pendidikan_kepolisian')==$pendidikan_kepolisian->nama ) selected @endif>{{ $pendidikan_kepolisian->nama }}</option>
                            @endforeach
                        </select>
                        @error('pendidikan_kepolisian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="photo" class="form-label">Photo</label>

                        @if ($user->photo === 'nopp.png')
                        <p>Previous File: <a
                                href="{{ asset('/images/' . $user->photo) }}"
                                target="_blank">{{ $user->photo }}</a></p>
                        @elseif ( isset($user->photo) )
                        <p>Previous File: <a
                                href="{{ asset('/storage/profile/' . $user->photo) }}"
                                target="_blank">{{ $user->photo }}</a></p>
                        @endif

                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" aria-describedby="photo" value="{{ old('nama_lengkap', $user->photo) }}" name="photo">

                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Save changes</button>
                        </div>
                    </div>
                </form>
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
<script>
    function pilih(id, nama_pegawai) {
        // Mengisi nilai input dengan data yang dipilih dari tabel
        document.getElementById('selected_id_users').value = id;
        document.getElementById('pegawai').value = nama_pegawai;
    }

</script>



@endpush
