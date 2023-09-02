@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Skema</h1>
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
                @elseif(session()->has('failed')) 
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <a href="{{ route('peserta.profile') }}">{{ session('failed') }}</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>   
                @endif
                <form action="{{ route('peserta.saveDaftarSkema', $skema->id_skema) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center">Pendaftaran Skema : {{ $skema->nama }}</h1>

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_ktp'))
                    <div class="mb-3">
                        <label for="file_syarat_ktp" class="form-label">Dokumen Persyaratan KTP</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_ktp') is-invalid @enderror" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx"  id="file_syarat_ktp" value="{{ old('file_syarat_ktp') }}" name="file_syarat_ktp" required>
                        @error('file_syarat_ktp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_kk'))
                    <div class="mb-3">
                        <label for="file_syarat_kk" class="form-label">Dokumen Persyaratan KK</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_kk') is-invalid @enderror" id="file_syarat_kk" value="{{ old('file_syarat_kk') }}" name="file_syarat_kk" required>
                        @error('file_syarat_kk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @if(str_contains(str_replace(',',' ',$skema->file_syarat), 'file_syarat_npwp'))
                    <div class="mb-3">
                        <label for="file_syarat_npwp" class="form-label">Dokumen Persyaratan NPWP</label>
                        <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                        <input type="file" class="form-control @error('file_syarat_npwp') is-invalid @enderror" id="file_syarat_npwp" value="{{ old('file_syarat_npwp') }}" name="file_syarat_npwp" required>
                        @error('file_syarat_npwp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    
                    @if($skema->status_peserta->where('id_users', Auth::user()->id_users)->first() !== null)
                        @if($skema->status_peserta->where('id_users', Auth::user()->id_users)->first()->status == 'lulus')
                        <div class="mb-3">
                            <label for="file_syarat_logbook" class="form-label">File Logbook</label>
                            <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png .pdf .docx</small>
                            <input type="file" class="form-control @error('file_syarat_logbook') is-invalid @enderror" accept=".jpeg, .jpg, .png, .pdf, .docx," id="file_syarat_logbook" value="{{ old('file_syarat_logbook') }}" name="file_syarat_logbook" required>
                            @error('file_syarat_logbook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>  
                        @endif
                    @endif

                    <div class="mb-3">
                        <label for="id_tuk" class="form-label">Tempat Uji Kompetensi (TUK)</label>
                        <select class="form-select @error('id_tuk') is-invalid @enderror" name="id_tuk" >
                            @foreach ($tuks as $tuk)
                                <option value="{{ $tuk->id_tuk }}" @if( $tuk->id_tuk === old('tuk')) selected @endif>{{ $tuk->nama }} - {{ $tuk->alamat }}</option>
                            @endforeach
                        </select>
                        @error('id_tuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-outline-secondary" onclick="notificationBeforeSubmit(event, this)">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@push('js')
<script>
    function notificationBeforeSubmit(event, el) {
        event.preventDefault();

        const skema = "{{ $skema->nama }}";
        Swal.fire({
            title: 'Konfirmasi',
            text: `Apakah anda yakin ingin mendaftar pada ${skema}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi penyimpanan, submit form
                el.closest('form').submit(); // Menggunakan el.closest() untuk mencari formulir terdekat
            }
        });
    }
</script>   
@endpush