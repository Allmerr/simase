@extends('adminlte::page')

@section('title', 'SI-MASE | Tambah Sertifikat')

@section('content_header')
    <h1 class="m-0">Tambah Sertifikat</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('sertifikat.store') }}" method="post" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="skema">Pilih Skema:</label>
                        <select id="skema" name="id_skema" class="form-select" required>
                            @foreach ($skemas as $skema)
                                <option value="{{ $skema->id_skema }}">{{ $skema->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_skema')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3" id="usersContainer">
                        <label for="user">Pilih Peserta:</label>
                        <small class="form-text text-muted">Peserta yang ditampilakan adalah peserta yang telah lulus dari skema yang dipilih</small>
                        <select id="user" name="id_user" class="form-select" required>
                        </select>
                        @error('id_user')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nomor_blanko" class="form-label">Nomor Blanko</label>
                        <input type="text" class="form-control @error('nomor_blanko') is-invalid @enderror" id="nomor_blanko" aria-describedby="nomor_blanko" name="nomor_blanko" required>
                        @error('nomor_blanko')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nomor_registrasi" class="form-label">Nomor Registrasi</label>
                        <input type="text" class="form-control @error('nomor_registrasi') is-invalid @enderror" id="nomor_registrasi" aria-describedby="nomor_registrasi" name="nomor_registrasi" required>
                        @error('nomor_registrasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_penetapan" class="form-label">Tanggal Penetapan</label>
                        <input type="date" class="form-control @error('tanggal_penetapan') is-invalid @enderror" id="tanggal_penetapan" aria-describedby="tanggal_penetapan" name="tanggal_penetapan" required>
                        @error('tanggal_penetapan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file_sertifikat" class="form-label">File Sertifikat</label>
                        <small class="form-text text-muted">Allow file extensions : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_sertifikat') is-invalid @enderror" id="file_sertifikat" aria-describedby="file_sertifikat" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" name="file_sertifikat" required>
                        @error('file_sertifikat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
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
    const schemeSelect = document.getElementById('skema');
    const usersContainer = document.getElementById('usersContainer');

    document.addEventListener('DOMContentLoaded', function() {
        const firstSchemeId = schemeSelect.value;
        fetchUsers(firstSchemeId);
    });

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
                    @error('id_user')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                `;
            });
    }
</script>

@endpush
