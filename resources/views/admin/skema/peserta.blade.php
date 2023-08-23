@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
   <h1 class="m-0 text-dark">Peserta : {{ $skema->nama }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="{{ route('skema.show', $skema->id_skema) }}">Detail</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('skema.pesertaSkema', $skema->id_skema) }}" >Peserta</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($skema->pengajuan) --}}
                                @foreach ($pengajuans as $key => $pengajuan)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pengajuan->user->nama_lengkap }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
@endpush
