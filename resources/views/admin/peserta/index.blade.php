@extends('adminlte::page')

@section('title', 'SI-MASE | Data Peserta')

@section('content_header')
    <h1 class="m-0">Data Peserta</h1>
@stop

@section('content')

{{-- @dd($skemas) --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.peserta.create') }}" class="btn btn-primary mb-2">Tambah</a>
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peserta</th>
                                    <th>Satuan Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->nama_lengkap}}</td>
                                    @if(isset($user->satker))
                                        <td>{{$user->satker->nama}}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('admin.peserta.show', $user->id_users) }}" class="btn btn-success btn-xs"><i class="fa fa-info"></i></a>
                                        <a href="{{ route('admin.peserta.edit', $user->id_users) }}" class="btn btn-primary btn-xs edit-button"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.peserta.destroy', $user->id_users) }}" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

