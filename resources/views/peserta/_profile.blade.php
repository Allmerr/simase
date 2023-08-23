@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

    <style>

        .main-profile .col-md-3 img{
            width: 100%;
        }

    </style>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="main-profile row ">
                
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>    
                    @endif

                    <h2 class="text-center">Profile: {{ auth()->user()->nama_lengkap }}</h2>
                    <hr>
                    <div class="col-md-3">
                        @if (auth()->user()->photo === 'nopp.png')
                            <img src="{{ asset('images/' . auth()->user()->photo) }}" alt="" class="rounded">            
                        @else
                            <img src="{{ asset('storage/profile/' .auth()->user()->photo) }}" alt="" class="rounded">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <form action="">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="name" class="form-control" id="nama_lengkap" aria-describedby="nama_lengkap" value="{{ auth()->user()->nama_lengkap }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="name" class="form-control" id="email" aria-describedby="email" value="{{ auth()->user()->email }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="no_telpon" class="form-label">No Telephone</label>
                                <input type="name" class="form-control" id="no_telpon" aria-describedby="no_telpon" value="{{ auth()->user()->no_telpon }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <input type="name" class="form-control" id="jenis_kelamin" aria-describedby="jenis_kelamin" value="{{ auth()->user()->jenis_kelamin }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="name" class="form-control" id="nip" aria-describedby="nip" value="{{ auth()->user()->nip }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="name" class="form-control" id="jabatan" aria-describedby="jabatan" value="{{ auth()->user()->jabatan }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="name" class="form-control" id="tempat_lahir" aria-describedby="tempat_lahir" value="{{ auth()->user()->tempat_lahir }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir" value="{{ auth()->user()->tanggal_lahir }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="name" class="form-control" id="alamat" aria-describedby="alamat" value="{{ auth()->user()->alamat }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota/Kabupaten</label>
                                <input type="name" class="form-control" id="kota" aria-describedby="kota" value="{{ auth()->user()->kota }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="name" class="form-control" id="provinsi" aria-describedby="provinsi" value="{{ auth()->user()->provinsi }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                <input type="name" class="form-control" id="pendidikan_terakhir" aria-describedby="pendidikan_terakhir" value="{{ auth()->user()->pendidikan_terakhir }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="satker" class="form-label">Satuan Kerja</label>
                                <input type="name" class="form-control" id="satker" aria-describedby="satker" value="{{ auth()->user()->satker ? auth()->user()->satker->nama : '' }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="pangkat" class="form-label">Pangkat</label>
                                <input type="name" class="form-control" id="pangkat" aria-describedby="pangkat" value="{{ auth()->user()->pangkat ? auth()->user()->pangkat->nama : '' }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="pendidikan_kepolisian" class="form-label">Pendidikan Kepolisian</label>
                                <input type="name" class="form-control" id="pendidikan_kepolisian" aria-describedby="pendidikan_kepolisian" value="{{ auth()->user()->pendidikan_kepolisian ? auth()->user()->pendidikan_kepolisian->nama : '' }}" disabled>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-primary w-100">Change Profile</a>
                            </div>
                        </div>
                    </div>
                </div>

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
                                        <input type="name" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" aria-describedby="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" name="nama_lengkap">
                                        @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ old('email', auth()->user()->email) }}" name="email">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="no_telpon" class="form-label">No Telephone</label>
                                        <input type="name" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" aria-describedby="no_telpon" value="{{ old('no_telpon', auth()->user()->no_telpon) }}" name="no_telpon">
                                        @error('no_telpon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" >
                                            <option value="Laki-Laki" @if(auth()->user()->jenis_kelamin == 'Laki-Laki' || old('jenis_kelamin')=='Laki-Laki' ) selected @endif>Laki-Laki</option>
                                            <option value="Perempuan" @if(auth()->user()->jenis_kelamin == 'Perempuan' || old('jenis_kelamin')=='Perempuan' ) selected @endif>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">Nip</label>
                                        <input type="name" class="form-control @error('nip') is-invalid @enderror" id="nip" aria-describedby="nip" value="{{ auth()->user()->nip }}" name="nip">
                                        @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <input type="name" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" aria-describedby="jabatan" value="{{ auth()->user()->jabatan }}" name="jabatan">
                                        @error('jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="name" class="form-control @error('jabatan') is-invalid @enderror" id="tempat_lahir" aria-describedby="tempat_lahir" value="{{ auth()->user()->tempat_lahir }}" name="tempat_lahir">
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" aria-describedby="tanggal_lahir" value="{{ auth()->user()->tanggal_lahir }}" name="tanggal_lahir">
                                        @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="name" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="alamat" aria-describedby="alamat" value="{{ auth()->user()->alamat }}" name="alamat">
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Kota/Kabupaten</label>
                                        <select class="form-select @error('kota') is-invalid @enderror" name="kota" >
                                            <option value="Kota Bogor" @if(auth()->user()->kota == 'Kota Bogor' || old('kota')=='Kota Bogor' ) selected @endif>Kota Bogor</option>
                                            <option value="Kab Kabupaten" @if(auth()->user()->kota == 'Kab Kabupaten' || old('kota')=='Kab Kabupaten' ) selected @endif>Kab Kabupaten</option>
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
                                            <option value="Jawa Barat" @if(auth()->user()->provinsi == 'Jawa Barat' || old('provinsi')=='Jawa Barat' ) selected @endif>Jawa Barat</option>
                                            <option value="DKI Jakarta" @if(auth()->user()->provinsi == 'DKI Jakarta' || old('provinsi')=='DKI Jakarta' ) selected @endif>DKI Jakarta</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                        <select class="form-select" name="pendidikan_terakhir" >
                                            <option value="Sarjana" @if(auth()->user()->pendidikan_terakhir == 'Sarjana' || old('pendidikan_terakhir')=='Sarjana' ) selected @endif>Sarjana</option>
                                            <option value="Magister" @if(auth()->user()->pendidikan_terakhir == 'Magister' || old('pendidikan_terakhir')=='Magister' ) selected @endif>Magister</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="satker" class="form-label">Satuan Kerja</label>
                                        <select class="form-select" name="id_satker" >
                                            @foreach ($satkers as $satker)
                                                <option value="{{ $satker->id_satker }}" @if((auth()->user()->satker ? auth()->user()->satker->nama : '') == $satker->nama || old('satker')==$satker->nama ) selected @endif>{{ $satker->nama }}</option>
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
                                                <option value="{{ $pangkat->id_pangkat }}" @if((auth()->user()->pangkat ? auth()->user()->pangkat->nama : '') == $pangkat->nama || old('pangkat')==$pangkat->nama ) selected @endif>{{ $pangkat->nama }}</option>
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
                                                <option value="{{ $pendidikan_kepolisian->id_pendidikan_kepolisian }}" @if((auth()->user()->pendidikan_kepolisian ? auth()->user()->pendidikan_kepolisian->nama : '') == $pendidikan_kepolisian->nama || old('pendidikan_kepolisian')==$pendidikan_kepolisian->nama ) selected @endif>{{ $pendidikan_kepolisian->nama }}</option>
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

                                        @if (auth()->user()->photo === 'nopp.png')
                                        <p>Previous File: <a
                                                href="{{ asset('/images/' . auth()->user()->photo) }}"
                                                target="_blank">{{ auth()->user()->photo }}</a></p>
                                        @elseif ( isset(auth()->user()->photo) )
                                        <p>Previous File: <a
                                                href="{{ asset('/storage/profile/' . auth()->user()->photo) }}"
                                                target="_blank">{{ auth()->user()->photo }}</a></p>
                                        @endif

                                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" aria-describedby="photo" value="{{ old('nama_lengkap', auth()->user()->photo) }}" name="photo">

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
            </div>
        </div>
    </div>
</div>
    
@stop