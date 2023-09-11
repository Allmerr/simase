@extends('adminlte::page')

@section('title', 'SIMASE | Data Pendidikan Kepolisian')

@section('content_header')
    <h1 class="m-0">Data Pendidikan Kepolisian</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('pendidikan-kepolisian.create') }}" class="btn btn-primary mb-2">Tambah</a>
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
                                    <th>Pendidikan Kepolisian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendidikan_kepolisians as $key => $pendidikan_kepolisian)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$pendidikan_kepolisian->nama}}</td>
                                    <td>
                                        <a href="{{ route('pendidikan-kepolisian.edit' , $pendidikan_kepolisian->id_pendidikan_kepolisian) }}" class="btn btn-primary btn-xs edit-button"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('pendidikan-kepolisian.destroy' , $pendidikan_kepolisian->id_pendidikan_kepolisian) }}" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

