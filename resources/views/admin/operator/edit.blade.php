@extends('adminlte::page')

@section('title', 'SIMASE | Edit Operator')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Operator</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.operator.update', $user->id_users) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ old('email', $user->email) }}" name="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" aria-describedby="password" value="{{ old('password') }}" name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" aria-describedby="password_confirmation" value="{{ old('password_confirmation') }}" name="password_confirmation">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="name" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" aria-describedby="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" name="nama_lengkap">
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="no_telpon" class="form-label">No Telephone</label>
                        <input type="name" class="form-control @error('no_telpon') is-invalid @enderror" id="no_telpon" aria-describedby="no_telpon" value="{{ old('no_telpon', $user->no_telpon) }}" name="no_telpon">
                        @error('no_telpon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

