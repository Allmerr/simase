@extends('adminlte::page')

@section('title', 'SI-MASE | Simpan Peserta')

@section('content_header')
    <h1 class="m-0">Simpan Peserta</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('admin.peserta.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="name" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" aria-describedby="nama_lengkap" value="{{ old('nama_lengkap') }}" name="nama_lengkap" required>
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ old('email') }}" name="email" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                            <option value="Laki-Laki" @if( old('jenis_kelamin') =='Laki-Laki' ) selected @endif>Laki-Laki</option>
                            <option value="Perempuan" @if( old('jenis_kelamin') =='Perempuan' ) selected @endif>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="no_telpon" class="form-label">No Telephone</label>
                        <input type="name" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" aria-describedby="no_telpon" value="{{ old('no_telpon') }}" name="no_telpon" required>
                        @error('no_telpon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nip" class="form-label">Nip</label>
                        <input type="name" class="form-control @error('nip') is-invalid @enderror" id="nip" aria-describedby="nip" value="{{ old('nip') }}" name="nip">
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">nik</label>
                        <input type="name" class="form-control @error('nik') is-invalid @enderror" id="nik" aria-describedby="nik" value="{{ old('nik') }}" name="nik">
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="name" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" aria-describedby="tempat_lahir" value="{{ old('tempat_lahir') }}" name="tempat_lahir">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" aria-describedby="tanggal_lahir" value="{{ old('tanggal_lahir') }}" name="tanggal_lahir">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="name" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" aria-describedby="jabatan" value="{{ old('jabatan') }}" name="jabatan">
                        @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pangkat" class="form-label">Pangkat</label>
                        <select class="form-select" name="id_pangkat" >
                            @foreach ($pangkats as $pangkat)
                                <option value="{{ $pangkat->id_pangkat }}" @if( old('pangkat')==$pangkat->nama ) selected @endif>{{ $pangkat->nama }}</option>
                            @endforeach
                        </select>
                        @error('pangkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="satker" class="form-label">Satuan Kerja</label>
                        <select class="form-select" name="id_satker" >
                            @foreach ($satkers as $satker)
                                <option value="{{ $satker->id_satker }}" @if(old('satker')==$satker->nama ) selected @endif>{{ $satker->nama }}</option>
                            @endforeach
                        </select>
                        @error('satker')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_pendidikan" class="form-label">Pendidikan Terakhir</label>
                        <select class="form-select" name="kode_pendidikan" >
                            @foreach ($pendidikans as $pendidikan)
                                <option value="{{ $pendidikan->kode_pendidikan }}" @if( old('pendidikan') == $pendidikan->kode_pendidikan ) selected @endif>{{ $pendidikan->nama_pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_kepolisian" class="form-label">Pendidikan Kepolisian</label>
                        <select class="form-select" name="id_pendidikan_kepolisian" >
                            @foreach ($pendidikan_kepolisians as $pendidikan_kepolisian)
                                <option value="{{ $pendidikan_kepolisian->id_pendidikan_kepolisian }}" @if( old('pendidikan_kepolisian')==$pendidikan_kepolisian->nama ) selected @endif>{{ $pendidikan_kepolisian->nama }}</option>
                            @endforeach
                        </select>
                        @error('pendidikan_kepolisian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_pekerjaan" class="form-label">Pekerjaan</label>
                        <select class="form-select" name="kode_pekerjaan" >
                            @foreach ($pekerjaans as $pekerjaan)
                                <option value="{{ $pekerjaan->kode_pekerjaan }}" @if( old('pekerjaan') == $pekerjaan->kode_pekerjaan ) selected @endif>{{ $pekerjaan->nama_pekerjaan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="name" class="form-control @error('alamat') is-invalid @enderror" id="alamat" aria-describedby="alamat" value="{{ old('alamat') }}" name="alamat">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kode_provinsi" class="form-label">Provinsi</label>
                        <select class="form-select" name="kode_provinsi" id="kode_provinsi" >
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->kode_provinsi }}" >{{ $provinsi->kode_provinsi }} - {{ $provinsi->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" id="kota_kabupaten_container">
                        <label for="kode_kota_kabupaten">Pilih Kota/Kabupaten:</label>
                        <small class="form-text text-muted">Kota/Kabupaten yang ditampilakan adalah Kota/Kabupaten yang telah dipilih berdasarkan provinsi</small>
                        <select id="kode_kota_kabupaten" name="kode_kota_kabupaten" class="form-select">
                            @foreach ($kota_kabupatens as $kota_kabupaten)
                                <option value="{{ $kota_kabupaten->kode_kota_kabupaten }}" >{{ $kota_kabupaten->kode_kota_kabupaten }} - {{ $kota_kabupaten->nama_kota_kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dikbangspes" class="form-label">Pendidikan Pengembangan Spesialis (DIKBANGSPES)</label>
                        <textarea class="form-control" name="dikbangspes" id="dikbangspes" cols="15" rows="3">{{ old('dikbangpes') }}</textarea>
                        @error('dikbangspes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pelatihan_diikuti" class="form-label">Pelatihan Yang Pernah Diikuti</label>
                        <textarea class="form-control" name="pelatihan_diikuti" id="pelatihan_diikuti" cols="15" rows="3">{{ old('pelatihan_diikuti')}}</textarea>
                        @error('pelatihan_diikuti')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterampilan_khusus" class="form-label">Keterampilan Khusus</label>
                        <textarea class="form-control" name="keterampilan_khusus" id="keterampilan_khusus" cols="15" rows="3">{{ old('keterampilan_khusus') }}</textarea>
                        @error('keterampilan_khusus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" aria-describedby="password" value="{{ old('password') }}" name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" aria-describedby="password_confirmation" value="{{ old('password_confirmation') }}" name="password_confirmation">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="photo" class="form-label">Photo</label>
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png </small>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" aria-describedby="photo" value="{{ old('nama_lengkap') }}" name="photo" accept=".jpg, .jpeg, .png">
                        @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('admin.peserta.index') }}" class="btn btn-warning w-100">Kembali</a>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script>
    const url = '{{ url('/') }}';
    const provinsiSelect = document.getElementById('kode_provinsi');
    const kotaKabupatenContainer = document.getElementById('kota_kabupaten_container');

    document.addEventListener('DOMContentLoaded', function() {
        const provinsiSelectId = provinsiSelect.value;
        fetchKabupatenKota(provinsiSelectId);
    });

    provinsiSelect.addEventListener('change', function() {
        const provinsiSelectId = this.value;
        fetchKabupatenKota(provinsiSelectId);
    });

    function fetchKabupatenKota(provinsiId) {
        fetch( url + `/peserta/kota-kabupaten/get-kota-kabupaten/${provinsiId}`)
            .then(response => {
                return response.json()
            })
            .then(data => {
                // Perbarui tampilan dengan daftar user
                kotaKabupatenContainer.innerHTML =  `
                    <label for="kode_kota_kabupaten">Pilih Kota/Kabupaten:</label>
                    <small class="form-text text-muted">Kota/Kabupaten yang ditampilakan adalah Kota/Kabupaten yang telah dipilih berdasarkan provinsi</small>
                    <select id="kode_kota_kabupaten" name="kode_kota_kabupaten" class="form-select">
                        ${data.kota_kabupatens.map(kota_kabupaten => {
                            return `<option value="${kota_kabupaten.kode_kota_kabupaten}">${kota_kabupaten.kode_kota_kabupaten} | ${kota_kabupaten.nama_kota_kabupaten}</option>`;
                        })}
                    </select>
                `;
            });
    }

</script>
@endpush
