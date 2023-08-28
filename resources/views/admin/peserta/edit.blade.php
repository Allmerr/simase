@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Peserta</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.peserta.update', $user->id_users) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
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
                        <input type="name" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" aria-describedby="tempat_lahir" value="{{ $user->tempat_lahir }}" name="tempat_lahir">
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
                        <input type="name" class="form-control @error('alamat') is-invalid @enderror" id="alamat" aria-describedby="alamat" value="{{ $user->alamat }}" name="alamat">
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
                        <label for="dikbangspes" class="form-label">Pendidikan Pengembangan Spesialis (DIKBANGSPES)</label>
                        <textarea class="form-control" name="dikbangspes" id="dikbangspes" cols="15" rows="3">{{ $user->dikbangspes }}</textarea>
                        @error('dikbangspes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pelatihan_diikuti" class="form-label">Pelatihan Yang Pernah Diikuti</label>
                        <textarea class="form-control" name="pelatihan_diikuti" id="pelatihan_diikuti" cols="15" rows="3">{{ $user->pelatihan_diikuti }}</textarea>
                        @error('pelatihan_diikuti')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterampilan_khusus" class="form-label">Keterampilan Khusus</label>
                        <textarea class="form-control" name="keterampilan_khusus" id="keterampilan_khusus" cols="15" rows="3">{{ $user->keterampilan_khusus }}</textarea>
                        @error('keterampilan_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

