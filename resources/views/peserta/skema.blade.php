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
                                {{-- <td>
                                    <a href="{{ route('peserta.detailSkema' , $skema->id_skema) }}" class="badge bg-primary">Detail</a>
                                    @if(!$skema->sudahDaftar(auth()->user()->id_users,$skema->id_skema))
                                    <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar</a>
                                    @elseif($skema->status_peserta()->where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->where('status', 'lulus')->exists())
                                    <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar Kembali</a>
                                    @else
                                    <a href="{{ route('peserta.statusPengajuan') }}" class="badge bg-warning">Status Pengajuan</a>
                                    @endif
                                </td> --}}
                                
                                <td>
                                    <a href="{{ route('peserta.detailSkema' , $skema->id_skema) }}" class="badge bg-primary">Detail</a>
                                    @if($skema->hasApprovedAndPassed() && ($skema->getLastApplicationStatus() === 'pending' || $skema->getLastApplicationStatus() === 'revisi' || $skema->getLastApplicationStatus() === 'pending_revisi' ||  $skema->hasApprovedAndNotPassedYet())) {{-- disetujui dan lulus dan sedang mendafar  --}}
                                    <a href="{{ route('peserta.statusPengajuan') }}" class="badge bg-warning">Status Pengajuan</a>
                                    @elseif($skema->hasApprovedAndPassed() && $skema->getLastApplicationStatus() === 'tidak_disetujui' ) {{-- disetujui dan lulus dan sedang mendafar  --}}
                                    <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar Kembali</a>
                                    @elseif($skema->hasApprovedAndPassed() && !($skema->getLastApplicationStatus() === 'pending' || $skema->getLastApplicationStatus() === 'revisi' || $skema->getLastApplicationStatus() === 'pending_revisi' ||  $skema->hasApprovedAndNotPassedYet())) {{-- disetujui dan lulus dan sedang mendafar  --}}
                                    <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar Kembali</a>
                                    @elseif($skema->getLastApplicationStatus() === 'pending' || $skema->getLastApplicationStatus() === 'revisi' || $skema->getLastApplicationStatus() === 'pending_revisi' ||  $skema->hasApprovedAndNotPassedYet())
                                    <a href="{{ route('peserta.statusPengajuan') }}" class="badge bg-warning">Status Pengajuan</a>
                                    @elseif($skema->getLastApplicationStatus() === 'tidak_disetujui')
                                    <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar</a>
                                    @else
                                    <a href="{{ route('peserta.daftarSkema' , $skema->id_skema) }}" class="badge bg-success">Daftar</a>
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
</script>
@endpush

