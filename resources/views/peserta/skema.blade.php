@extends('adminlte::page')

@section('title', 'SI-MASE | Data Skema')

@section('content_header')
    <h1 class="m-0">Data Skema</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Gambar</th>
                                <th>Kode Skema</th>
                                <th>Nama Skema</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($skemas as $key => $skema)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    @if ($skema->photo == 'noskema.png')
                                    <img src="{{ asset('/images/' . $skema->photo) }}" alt="" width="150">
                                    @else
                                    <img src="{{ asset('/storage/skema/' . $skema->photo) }}" alt="" width="150">
                                    @endif
                                </td>
                                <td>{{ $skema->kode }}</td>
                                <td>{{ $skema->nama }}</td>
                                <td>
                                    <a href="{{ route('peserta.detailSkema' , $skema->id_skema) }}" class="badge bg-primary">Detail</a>
                                    @if($skema->status == 'aktif')

                                        @if($skema->hasApprovedAndPassed() && ($skema->getLastApplicationStatus() === 'menunggu_pending' || $skema->getLastApplicationStatus() === 'pending' || $skema->getLastApplicationStatus() === 'revisi' || $skema->hasApprovedAndNotPassedYet())) {{-- disetujui dan lulus dan sedang mendafar  --}}

                                            <a href="{{ route('peserta.statusPengajuan') }}" class="badge bg-warning">Status Pengajuan</a>

                                        @elseif($skema->hasApprovedAndPassed() && $skema->getLastApplicationStatus() === 'tidak_disetujui' ) {{-- disetujui dan lulus dan sedang mendafar  --}}

                                            <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar Kembali</a>

                                        @elseif($skema->hasApprovedAndPassed() && !($skema->getLastApplicationStatus() === 'menunggu_pending' || $skema->getLastApplicationStatus() === 'pending' || $skema->getLastApplicationStatus() === 'revisi' || $skema->hasApprovedAndNotPassedYet())) {{-- disetujui dan lulus dan sedang mendafar  --}}

                                            <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar Kembali</a>

                                        @elseif($skema->getLastApplicationStatus() === 'menunggu_pending' || $skema->getLastApplicationStatus() === 'pending' || $skema->getLastApplicationStatus() === 'revisi' || $skema->hasApprovedAndNotPassedYet())

                                            <a href="{{ route('peserta.statusPengajuan') }}" class="badge bg-warning">Status Pengajuan</a>

                                        @elseif($skema->getLastApplicationStatus() === 'tidak_disetujui')

                                            <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar</a>

                                        @else

                                            <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar</a>

                                        @endif
                                    @else
                                        <a href="#" class="badge bg-secondary">Sertifikat Non-aktif</a>
                                    @endif
                                </td>
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
<script>
$('#example2').DataTable({
    "responsive": true,
});

@if(session()->has('success'))
    Swal.fire({
        title: 'Berhasil Mendaftar!',
        text: 'Nantikan Notifikasi Selajutnya!.',
        icon: 'success'
    });
@endif
</script>
@endpush

