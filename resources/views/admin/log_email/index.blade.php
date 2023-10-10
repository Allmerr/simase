@extends('adminlte::page')

@section('title', 'SI-MASE | Log Email')

@section('content_header')
    <h1 class="m-0">Log Email</h1>
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
                                    <th>Hal</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($log_emails as $key => $log_email)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $log_email->hal }}</td>
                                    <td>{{ $log_email->email }}</td>
                                    <td>{{ $log_email->status }}</td>
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

