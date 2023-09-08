@extends('adminlte::page')

@section('title', 'SIMASE | TUK')

@section('content_header')
    <h1 class="m-0 text-dark"> Tempat Uji Kompetensi</h1>
@stop

@section('content')

{{-- @dd($skemas) --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('tuk.create') }}" class="btn btn-primary mb-2">Tambah</a>
                    <div class="table-responsive">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Tempat Uji Kompotensi (TUK)</th>
                                    <th>Alamat Tempat Uji Kompotensi (TUK)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tuks as $key => $tuk)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$tuk->nama}}</td>
                                    <td>{{$tuk->alamat}}</td>
                                    <td>
                                        <a href="{{ route('tuk.edit', $tuk->id_tuk) }}" class="btn btn-primary btn-xs edit-button"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('tuk.destroy', $tuk->id_tuk) }}" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

