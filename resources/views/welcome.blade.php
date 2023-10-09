@extends('adminlte::welcome')


@section('content_header')
    <img src="{{ asset('images/lsp.png') }}" alt="" class="img-heading mx-auto d-block" style="">
    <h4 class="m-0">Daftar Pemegang Sertifikat</h4>
@stop

@section('content')
<style>
    img.img-heading {
        height: 50%;
        width: 50%;
        object-fit: contain
    }

    .content-wrapper{
        margin-left: auto !important;
        padding: 30px;
    }

    .content-header .heading-content{
        margin-top: 30px;
    }

    @media(max-width: 768px){
        .content-wrapper{
            padding: 0px;
        }

        .content-header .heading-content{
            margin-top: 50px;
        }

        img.img-heading {
            height: 100%;
            width: 100%;
            object-fit: contain
        }
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('welcome') }}" method="GET">
                        <div class="form-group d-flex">

                            <select name="id_skema" id="id_skema" class="form-select col-md-3">
                                <option value="all">All Skema</option>
                                @foreach ($skemas as $skema)
                                    <option value="{{ $skema->id_skema }}" @if(request()->id_skema == $skema->id_skema) selected @endif>{{ $skema->nama }}</option>
                                @endforeach
                            </select>

                            <select name="year" id="year" class="form-select col-md-3">
                                <option value="all">All Years</option>

                                @php
                                $currentYear = date('Y');
                                $startYear = 2025;
                                @endphp
                                @for ($year = $startYear; $year >= $currentYear; $year--)
                                    @if ($year == request()->year)
                                        <option value="{{ $year }}" selected>{{ $year }}</option>
                                    @else
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endif
                                @endfor

                            </select>
                            <button type="submit" class="btn btn-primary ml-2">Cari</button>
                        </div>
                    </form>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Peserta</th>
                                <th>Nomor Blanko</th>
                                <th>Nama Skema</th>
                                <th>Berlaku Sampai Dengan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($status_pesertas->count() != 0)

                            @foreach($status_pesertas as $key => $status_peserta)
                            @if($status_peserta->file_sertifikat !== null)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $status_peserta->user->nama_lengkap }}</td>
                                <td>{{ $status_peserta->nomor_blanko }}</td>
                                <td>{{ $status_peserta->skema->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($status_peserta->tanggal_expired)->format('d M Y') }}</td>
                            </tr>

                            @endif
                            @endforeach

                            @endif

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
