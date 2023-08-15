@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')

{{-- @dd($skemas) --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('skema.create') }}" class="btn btn-primary mb-2">Tambah</a>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Skema</th>
                                    <th>Nama Skema</th>
                                    <th>Photo</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skemas as $key => $skema)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$skema->kode}}</td>
                                    <td>{{$skema->nama}}</td>
                                    <td id={{$key+1}}>
                                        @if ($skema->photo === 'noskema.png')
                                            <a href="{{ asset('/images/'. $skema->photo) }}" target="_blank">Lihat Dokumen</a>
                                        @else
                                            <a href="{{ asset('/storage/skema/'. $skema->photo) }}" target="_blank">Lihat Dokumen</a>
                                        @endif
                                    </td>
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

</script>
@endpush

