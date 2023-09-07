@extends('adminlte::page')

@section('title', 'SIMASE | Skema')

@section('content_header')
    <h1 class="m-0 text-dark">Skema</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('skema.create') }}" class="btn btn-primary mb-2">Create</a>
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
                                    <th>Nama Skema</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Status Skema</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skemas as $key => $skema)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$skema->nama}}</td>
                                    <td>{{ $skema->pengajuan()->distinct('id_users')->count() }}</td>
                                    <td>{{$skema->status}}</td>
                                    <td>
                                        <a href="{{ route('skema.show', $skema->id_skema) }}" class="btn btn-success btn-xs"><i class="fa fa-info"></i></a>
                                        <a href="{{ route('skema.edit' , $skema->id_skema) }}" class="btn btn-primary btn-xs edit-button"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('skema.destroy' , $skema->id_skema) }}" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

@if(session()->has('success'))
    Swal.fire({
        title: 'Berhasil Mendaftar!',
        text: '{{  session('success') }}',
        icon: 'success'
    });
@endif
</script>
@endpush

