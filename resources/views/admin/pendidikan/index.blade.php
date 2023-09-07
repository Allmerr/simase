@extends('adminlte::page')

@section('title', 'SIMASE | Pendidikan')

@section('content_header')
    <h1 class="m-0 text-dark">Pendidikan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('pendidikan.create') }}" class="btn btn-primary mb-2">Create</a>
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
                                    <th>Kode Pendidikan</th>
                                    <th>Nama Pendidikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendidikans as $key => $pendidikan)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$pendidikan->kode_pendidikan}}</td>
                                    <td>{{$pendidikan->nama_pendidikan}}</td>
                                    <td>
                                        <a href="{{ route('pendidikan.edit', $pendidikan->id_pendidikan) }}" class="btn btn-primary btn-xs edit-button"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('pendidikan.destroy', $pendidikan->id_pendidikan) }}" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

