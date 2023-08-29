@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Isi Survey</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('peserta.survey.store', $survey->id_status_peserta) }}" method="post">
                    @method('POST')
                    @csrf
                    <input type="hidden" value="{{ $survey->nomor_blanko }}" name="nomor_blanko">
                    <input type="hidden" value="{{ $survey->id_skema }}" name="id_skema">
                    <div class="mb-3">
                        <label for="nomor_blanko" class="form-label">Nomor Blanko</label>
                        <input type="text" class="form-control" id="nomor_blanko" aria-describedby="nomor_blanko" value="{{ $survey->nomor_blanko }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="skema" class="form-label">Nama Skema</label>
                        <input type="text" class="form-control" id="skema" aria-describedby="skema" value="{{ $survey->skema->nama }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan Saat Ini</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" aria-describedby="pekerjaan" value="{{ old('pekerjaan') }}" name="pekerjaan">
                        @error('pekerjaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="instansi" class="form-label">Instansi Saat Ini</label>
                        <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" aria-describedby="instansi" value="{{ old('instansi') }}" name="instansi">
                        @error('instansi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Apakah pekerjaan saat ini sesuai dengan sertifikat yang didapat dan diambil</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="sesuai" id="keterangan_sesuai" name="keterangan">
                            <label class="form-check-label" for="keterangan_sesuai">
                              Sesuai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="tidak sesuai" id="keterangan_tidak_sesuai" name="keterangan">
                            <label class="form-check-label" for="keterangan_tidak_sesuai">
                              Tidak Sesuai
                            </label>
                        </div>
                        @error('keterangan')
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