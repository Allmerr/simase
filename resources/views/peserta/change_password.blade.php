@extends('peserta.layouts.main')
@section('content')
    <style>
        .main-profile{
            margin: 0 300px;
        }

        .main-profile .col-md-3 img{
            width: 100%;
        }

    </style>

    <div class="main-profile border rounded row p-3">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>    
        @endif
        <h2 class="text-center">Change Password</h2>
        <hr>

        <form action="{{ route('peserta.changePassword') }}" method="post"> 
            @csrf
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" autofocus>
                @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row mt-2">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Save changes</button>
                </div>
            </div>
        </form>

    </div>
    
@endsection