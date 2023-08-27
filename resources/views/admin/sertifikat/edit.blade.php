@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Ubah Sertifikat</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('sertifikat.update', $status_peserta->id_skema) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    {{-- @dd($status_peserta->user) --}}
                    <input type="hidden" name="id_skema" value="{{ $status_peserta->id_skema }}">
                    <input type="hidden" name="id_user" value="{{ $status_peserta->id_users }}">
                    <div class="mb-3">
                        <label for="skema">Pilih Skema:</label>
                        <select id="skema" name="id_skema" class="form-select" required disabled>
                            @foreach ($skemas as $skema)
                                <option value="{{ $skema->id_skema }}">{{ $skema->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" id="usersContainer">
                        <label for="user">Pilih Peserta:</label>
                        <small class="form-text text-muted">Peserta yang ditampilakan adalah peserta yang telah lulus dari skema yang dipilih</small>
                        <select id="user" name="id_user" class="form-select" required disabled>
                            <option value="{{ $status_peserta->user->id_user }}" selected>{{ $status_peserta->user->nama_lengkap }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_blanko" class="form-label">Nomor Blanko</label>
                        <input type="text" class="form-control" id="nomor_blanko" aria-describedby="nomor_blanko" name="nomor_blanko" value="{{ old('nomor_blanko', $status_peserta->nomor_blanko) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_registrasi" class="form-label">Nomor Registrasi</label>
                        <input type="text" class="form-control" id="nomor_registrasi" aria-describedby="nomor_registrasi" name="nomor_registrasi" value="{{ old('nomor_registrasi', $status_peserta->nomor_registrasi) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_penetapan" class="form-label">Tanggal Penetapan</label>
                        <input type="date" class="form-control" id="tanggal_penetapan" aria-describedby="tanggal_penetapan" name="tanggal_penetapan" value="{{ old('tanggal_penetapan', $status_peserta->tanggal_penetapan) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_sertifikat" class="form-label">File Sertifikat</label>
                        <br>
                        <a href="{{ asset('storage/file_sertifikat/' . $status_peserta->file_sertifikat) }}">Lihat File Sebelumnya</a>
                        <input type="file" class="form-control" id="file_sertifikat" aria-describedby="file_sertifikat" name="file_sertifikat" value="{{ old('file_sertifikat') }}" >
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Tambah</button>
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
    const schemeSelect = document.getElementById('skema');
    const usersContainer = document.getElementById('usersContainer');

    schemeSelect.addEventListener('change', function() {
        const selectedSchemeId = this.value;
        fetchUsers(selectedSchemeId);
    });

    function fetchUsers(schemeId) {
        fetch( url + `/admin/sertifikat/get-users/${schemeId}`)
            .then(response => {
                return response.json()
            })
            .then(data => {
                // Perbarui tampilan dengan daftar user
                usersContainer.innerHTML =  `
                    <label for="user">Pilih Peserta:</label>
                    <small class="form-text text-muted">Peserta yang ditampilakan adalah peserta yang telah lulus dari skema yang dipilih</small>
                    <select id="user" name="id_user" class="form-select">
                        ${data.users.map(user => {
                            return `<option value="${user.user.id_users}">${user.user.nama_lengkap}</option>`;
                        })}
                    </select>
                `;
            });
    }
</script>

@endpush 